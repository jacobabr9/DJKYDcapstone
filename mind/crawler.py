import feedparser
import logging
import mysql.connector

# Configure logging
logging.basicConfig(filename='crawler_log.txt', level=logging.INFO)

def log_message(message):
    logging.info(message)

# Function to connect to the MySQL database
def connect_to_db():
    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",  # Your MySQL username
            password="",  # Your MySQL password (if any)
            database="djkyd"  # The name of your database
        )
        if conn.is_connected():
            log_message("Successfully connected to the database.")
            return conn
        else:
            log_message("Failed to connect to the database.")
            return None
    except mysql.connector.Error as err:
        log_message(f"Error: {err}")
        return None

# Function to insert article into the database
def insert_article_into_db(career_id, source_name, title, body, link):
    conn = connect_to_db()
    if conn is None:
        return  # If connection fails, don't proceed

    cursor = conn.cursor()

    try:
        # Use a prepared statement to avoid SQL injection
        cursor.execute("""
            INSERT INTO news (`Source Name`, `Title`, `CareerID`, `Body`, `Link`)
            VALUES (%s, %s, %s, %s, %s)
        """, (source_name, title, career_id, body, link))
        
        conn.commit()  # Commit the transaction
        log_message(f"Article '{title}' inserted into the database.")
    except mysql.connector.Error as err:
        log_message(f"Error inserting article '{title}': {err}")
    finally:
        cursor.close()
        conn.close()

# Function to fetch articles from Google News RSS
def fetch_articles_rss(keywords, max_articles_per_keyword=5):
    articles = []
    base_url = "https://news.google.com/rss/search?q={}"

    for keyword in keywords:
        rss_url = base_url.format(keyword.replace(' ', '+'))  # Format the URL with the keyword
        feed = feedparser.parse(rss_url)

        print(f"Request to {rss_url} returned status code {200}")

        article_count = 0
        for entry in feed.entries:
            # Only add relevant articles that have keywords in the title
            if any(k.lower() in entry.title.lower() for k in keywords):
                # Add article with the necessary details
                articles.append({
                    'source_name': entry.source.title if hasattr(entry, 'source') else 'Unknown',  # Handle missing source
                    'title': entry.title,
                    'body': entry.summary,  # Summary as the body (you may refine this)
                    'link': entry.link
                })
                article_count += 1
            
            # Stop when we reach the limit of articles for this keyword
            if article_count >= max_articles_per_keyword:
                break

    return articles

# Function to fetch career paths and their keywords from the database
def fetch_career_paths():
    conn = connect_to_db()
    if conn is None:
        return []  # Return empty list if connection fails

    cursor = conn.cursor()

    try:
        cursor.execute("SELECT CareerID, Keywords FROM career_path")
        career_paths = cursor.fetchall()

        return career_paths
    except mysql.connector.Error as err:
        log_message(f"Error fetching career paths: {err}")
        return []
    finally:
        cursor.close()
        conn.close()

# Main function to perform the scraping and inserting
def main():
    # Fetch career paths and their associated keywords
    career_paths = fetch_career_paths()

    if not career_paths:
        log_message("No career paths found. Exiting.")
        return

    log_message("Crawler started.")
    
    # Loop through all career paths
    for career_id, keywords in career_paths:
        keyword_list = keywords.split(',')  # Extract keywords for the current career path
        
        # Log career path info
        log_message(f"Scraping for career path ID {career_id} with keywords: {keywords}")
        
        # Fetch articles using RSS
        articles = fetch_articles_rss(keyword_list)
        
        # Insert the articles into the database
        for article in articles:
            insert_article_into_db(career_id, article['source_name'], article['title'], article['body'], article['link'])

    log_message("Crawler finished.")

# Execute the main function
if __name__ == "__main__":
    main()
