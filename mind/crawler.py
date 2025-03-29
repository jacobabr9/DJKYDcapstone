import feedparser
import logging
import requests

# Configure logging
logging.basicConfig(filename='crawler_log.txt', level=logging.INFO)

def log_message(message):
    logging.info(message)

# Function to send article to PHP script for insertion
def send_article_to_php(career_id, title, link):
    url = "http://localhost/myPHP/DJKYDcapstone/mind/crawler-handler.php"  # Updated URL to PHP handler
    
    # Prepare the data to send via POST request
    data = {
        'career_id': career_id,
        'title': title,
        'link': link
    }
    
    # Send a POST request to the PHP file
    try:
        response = requests.post(url, data=data)
        
        # Debugging: Print the response text to help track the issue
        print("Response from PHP:", response.text)  # Added debug print
        
        if response.status_code == 200:
            log_message(f"Article '{title}' sent to PHP for insertion.")
            print(f"Article '{title}' sent to PHP for insertion.")
        else:
            log_message(f"Failed to send article '{title}' to PHP. Status code: {response.status_code}")
            print(f"Failed to send article '{title}' to PHP. Status code: {response.status_code}")
    except Exception as e:
        log_message(f"Error sending article '{title}' to PHP: {str(e)}")
        print(f"Error sending article '{title}' to PHP: {str(e)}")

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

# Function to fetch career paths and their keywords from the database
def fetch_career_paths():
    # You can add a database connection here if you need to fetch career paths dynamically
    # For now, let's assume this is a static list of career paths with keywords
    return [
        (1, "developer, programmer"),
        (2, "data analyst, data science"),
        (3, "designer, creative"),
        # Add more career paths here
    ]

# Main function to perform the scraping and sending
def main():
    # Fetch career paths and their associated keywords
    career_paths = fetch_career_paths()

    log_message("Crawler started.")
    
    # Loop through all career paths
    for i, (career_id, keywords) in enumerate(career_paths):
        keyword_list = keywords.split(',')  # Extract keywords for the current career path
        
        # Log career path info
        log_message(f"Scraping for career path ID {career_id} with keywords: {keywords}")
        
        # Fetch articles using RSS
        articles = fetch_articles_rss(keyword_list)
        
        # Send the articles to PHP for insertion
        for article in articles:
            send_article_to_php(career_id, article['title'], article['link'])

    log_message("Crawler finished.")

# Execute the main function
if __name__ == "__main__":
    main()
