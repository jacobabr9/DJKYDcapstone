import mysql.connector
import feedparser
import logging

# Configure logging
logging.basicConfig(filename='crawler_log.txt', level=logging.INFO)

def log_message(message):
    logging.info(message)

# Connect to the MySQL database
db = mysql.connector.connect(
    host="djkyd-ai-support.site",  #  server host 
    user="root",  #  MySQL username
    password="djkyd",  #  MySQL password
    database="djkyd"  #  database name
)

cursor = db.cursor()

# Function to test the database connection
def test_database_connection():
    try:
        cursor.execute("SELECT 1")
        result = cursor.fetchone()
        if result:
            log_message("Database connection successful!")
            print("Database connection successful!")
        else:
            log_message("Database connection failed!")
            print("Database connection failed!")
    except Exception as e:
        log_message(f"Error testing database connection: {str(e)}")
        print(f"Error testing database connection: {str(e)}")

# Function to fetch career paths and their keywords from the database
def fetch_career_paths():
    cursor.execute("SELECT `CareerID`, `Keywords` FROM `career_path`")
    return cursor.fetchall()

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
                articles.append({
                    'title': entry.title,
                    'link': entry.link
                })
                article_count += 1
            
            # Stop when we reach the limit of articles for this keyword
            if article_count >= max_articles_per_keyword:
                break

    return articles

# Function to insert scraped articles into the database
def insert_article(career_id, title, link):
    # Prepare the SQL query to insert the article
    query = "INSERT INTO `news` (`CareerID`, `Title`, `Link`) VALUES (%s, %s, %s)"
    cursor.execute(query, (career_id, title, link))
    db.commit()

# Main function to perform the scraping and storing
def main():
    # Test the database connection before starting the crawl
    test_database_connection()

    # Fetch career paths and their associated keywords
    career_paths = fetch_career_paths()

    log_message("Crawler started.")
    
    # Set of previously inserted articles (to avoid duplicates)
    inserted_articles = set()
    
    # Add the AI keyword for replacing IT jobs
    ai_keywords = ["AI replacing IT jobs", "AI automation IT", "AI technology job replacement"]

    # Loop through all career paths (including AI-related jobs for Career Path ID 10)
    for i, (career_id, keywords) in enumerate(career_paths):
        keyword_list = keywords.split(',') + ai_keywords if career_id == 10 else keywords.split(',')  # Add AI-related keywords for Career Path 10
        
        # Log career path info
        log_message(f"Scraping for career path ID {career_id} with keywords: {keywords}")
        
        # Fetch articles using RSS
        articles = fetch_articles_rss(keyword_list)
        
        # Insert the articles into the database, avoiding duplicates
        for article in articles:
            if article['link'] not in inserted_articles:
                insert_article(career_id, article['title'], article['link'])
                inserted_articles.add(article['link'])
                log_message(f"Inserted article: {article['title']}")
                print(f"Inserted article: {article['title']}")

    log_message("Crawler finished.")

# Execute the main function
if __name__ == "__main__":
    main()
