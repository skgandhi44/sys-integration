# Nutrisize: A nutrition suggestion API #

The repository contains all of the code needed to run Nutrition suggetion web. This is created as a project for IT490-001, System Integration class at NJIT under Donald Kehoe. User will be able to insert name/upc of a product, and that will dispaly A nutrition lable of that product. you will also be able to Maintain user health profile, keep count of diet and calories defict. it also gives the user Personal diet and excercise Recomandation. based on the excersies recomandation, it will provide friend and group matiching. You can see technologies used in the project below.
 
 
  * Front End:              PHP, HTML, CSS, JavaScript and Bootstrap
  * Back End:               PHP
  * DMZ:                    PHP-CURL
  * Technology:             RabbitMQ, MySQL, GIT, trello, Nagios, OSSIM
  * Nutrition Data Source:  Nutritionix
 
 ## Getting Started ##
 
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. The repository is divided into 3 folders i.e. frontend, dmz, database. 
  
### Setting up ###

Followig will show the instructions on how to set up the files and listener files to test the website:

 * RabbitMQ:
   * Enable rabbitmq_management_plugin and start the RabbitMQ in the web browser.
   * Make three exchanges for the communication between front-end to database and database to dmz
     * First exchange: vh, e1 and q1
     * Second exchange: vh2, e2 and q2
     * Third exchange: vh3, e3, BE1, BE2, FE1, FE2, DMZ1, DMZ2
 
 * Database:
   * Change /database/rabbitmqphp_example/testRabbitMQ.ini, rabbitMQ_RMQ.ini, rabbitMQ_dmz.ini files and assign BROKER_HOST the IP address of RabbitMQ server
   * In terminal start /database/php/dbListner.php (this will start listening to RMQ messages)
   
 * DMZ:
   * Change /dmz/rabbitmqphp_example/testRabbitMQ.ini, rabbitMQ_RMQ.ini files and assign BROKER_HOST the IP address of RabbitMQ server
   * In terminal start /dmz/php/dbListner.php 
   
 * Front End:
   * Change /frontend/rabbitmqphp_example/testRabbitMQ.ini, rabbitMQ_RMQ.ini, rabbitMQ_DMZ.ini files and assign BROKER_HOST the IP address of RabbitMQ server
   * Open /frontend/html/nutrisize.html in browser to begin testing
   
 ## Running the tests ##
 
  * Open sys-integration/frontend/html/nutrisize.html in browser for testing
  * Sign Up?
    * Enter fields as specified to register a new user and then submit
    * Enter alergies if any and then submit
  * Sign in
    * Sign in with the register email and password
  * Homepage:
    * Homepage has BMI setup
  * Search Page:
    * Enter a food name and then search
    * After search, a Box with picture of the product, and nutrition facts will appear.
    * At the bottem of the page there will be a add button. you can add th food that you ate for the day. 
    * It will count the total calories.
    * You can remove the food, if you add it by mistake.
    * IT will also suggest some excersise options for burning the calories.
  * Example:
    * To test the search, Insert Orange. 
    * Nutrition box with picture of an orange and nutrion facts will appear.
    * Click the add button, at the end of the box to add the food for the day. 
    * Click the remove button, to remove the food
    * It will show Excersise recomandations.
## Nutritionix ##
  * We would like to thank Nutritionix for providing us with API access free of use for this project. 

## Authors ##

  * Shivam Gandhi- FrontEnd Devloper- skg44
  * Milind Patel- Database Devloper- mrp72
  * Rushabh Patel- Network Administrator- rdp48
  * Jay Patel- System Administartor- jp772
  * Kishan Patel- OSSIM, Nagios - kp628
## Acknowledgements ##
    
