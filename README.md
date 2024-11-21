## Project Overview

Application that consumes the OMDB API

- Movie Search: Allow users to search for movies by title
- Movie Details: Display detailed information about a selected movie
- Trending Movies: Show a list of trending or popular movies based on your own logic (e.g.,most searched, recently added).

## Setups

- Install PHP version 8.2.12
- Install Composer version 2.6.4
- For unit testing run "composer require --dev phpunit/phpunit" to install the install the required libraries

## Installation Steps

1. Clone the repository: https://github.com/phiwe-saba/MovieAPIIntegration.git
2. Download the composer version 2.6.4. To download go to the website and check the documentation on how to properly install the application.
3. Environment Configuration: API Key - b6003d8a
4. Run the application on the terminal using "php artisan serve" and click on the link
![image](https://github.com/user-attachments/assets/e74b85b8-6008-4691-b2db-351fdf30f385)


## Usage Instructions

After launching the application the following page will appear.
![image](https://github.com/user-attachments/assets/f045161e-fd8e-462e-bc4f-2e0d280389a3)

## *Movie Search:*
Enter the name of the movie you want to see and the results will appear
![image](https://github.com/user-attachments/assets/cbfb8437-66c5-46cd-b035-750fd9c9fee3)
![image](https://github.com/user-attachments/assets/36934569-f730-4afd-a5dc-4c9ac71eac23)

View Movie Details:
- To view specific details for a movie click on the movie name and the details will appear
![image](https://github.com/user-attachments/assets/7b082da3-939d-4dc1-ad13-6cc167892103)

View Trending Movies:
On the navigation bar click the "Trending Movies" tab.
![image](https://github.com/user-attachments/assets/f631d36d-8412-403f-97f0-82552755721b)

Trending movies will appear. 
![image](https://github.com/user-attachments/assets/4a79dc19-38da-483e-8d37-c58bf24d95cf)

## API Endpoints
These endpoint can be tested on Postman or it can be tested on the terminal.

1. Search Movies: 

POSTMAN:

TERMINAL:


2. Movie Details:

3. Trending Movies:

## UNIT Testing

For unit testing we use PHPUnit and to run the tests run the following command on the terminal

These are results after running the command

## Assumptions and Improvements

1. In terms of the design to avoid duplication of code I should have created a layout page that could be implemented on all the pages instead of repeating the code for the navigation ba.
2. The way in which the error messages are returned can be improved so that they are more clear and concise.
3. Caching results for 60 minutes is making the application slow, this can be improved if I decrease the time to 10 minutes.
4. Pagination design needs to be improved.
5. For the APIs I should have authenticated them with tokens.
