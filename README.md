# **TheDocs API**

**TheDocs API** is a simple and powerful PHP package that allows developers to interact with various endpoints to fetch random users, posts, and images. It's a convenient library to integrate into your PHP project for accessing predefined API endpoints.

## **Installation**

You can easily install **TheDocs API** via Composer.

```bash
composer require abefe/thedocs-api

Replace abefe/thedocs-api with the actual package name if different.

Usage
1. Fetch Random Users
The API provides an endpoint to fetch a list of random users.


<?php

use abefe\TheDocsApi\RandomUsers;

$randomUsers = new RandomUsers();
$response = $randomUsers->get();

// Output the response
echo $response;

2. Fetch Random Posts
The API also provides an endpoint to fetch a list of random posts.

<?php

use abefe\TheDocsApi\RandomPosts;

$randomPosts = new RandomPosts();
$response = $randomPosts->get();

// Output the response
echo $response;

3. Fetch Random Images
Additionally, you can fetch random images using the provided endpoint.

<?php

use abefe\TheDocsApi\RandomImages;

$randomImages = new RandomImages();
$response = $randomImages->get();

// Output the response
echo $response;

Example
Here’s how you can combine all the features in a simple script:


<?php

require 'vendor/autoload.php';

use abefe\TheDocsApi\RandomUsers;
use abefe\TheDocsApi\RandomPosts;
use abefe\TheDocsApi\RandomImages;

// Fetch random users
$randomUsers = new RandomUsers();
$users = $randomUsers->get();

// Fetch random posts
$randomPosts = new RandomPosts();
$posts = $randomPosts->get();

// Fetch random images
$randomImages = new RandomImages();
$images = $randomImages->get();

// Display data
echo "Users: \n";
print_r($users);

echo "\nPosts: \n";
print_r($posts);

echo "\nImages: \n";
print_r($images);
Methods
RandomUsers: Fetches random user data from https://thedocs.loma.com.ng/api.php/random-users.
RandomPosts: Fetches random post data from https://thedocs.loma.com.ng/api.php/random-posts.
RandomImages: Fetches random image data from https://thedocs.loma.com.ng/api.php/random-images.
Each class has a get() method to fetch the data.

Requirements
PHP >= 7.4
cURL (for making HTTP requests)
Composer for installation
License
TheDocs API is licensed under the MIT License. See LICENSE for more details.

Contributing
We welcome contributions to TheDocs API. Feel free to fork the repository and submit pull requests with any bug fixes, improvements, or new features.

Fork the repository.
Create a new branch (git checkout -b feature-name).
Make your changes and commit (git commit -am 'Add new feature').
Push to the branch (git push origin feature-name).
Create a new pull request.


Author
Adeagbo Josiah
[GitHub Profile](https://github.com/intellidevelopers)


