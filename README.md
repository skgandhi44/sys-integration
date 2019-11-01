# Nutrisize: A nutrition suggestion API #

The repository contains all of the code needed to run Nutrition suggetion web. This is created as a project for IT490-001, System Integration class at NJIT under Donald Kehoe. User will be able to insert name/upc of a product, and that will dispaly A nutrition lable of that product. you will also be able to Maintain user health profile, keep count of diet and calories defict. it also gives the user Personal diet and excercise Recomandation. based on the excersies recomandation, it will provide friend and group matiching. You can see technologies used in the project below.
 
 
  * Front End:              PHP, HTML, CSS, JavaScript and Bootstrap
  * Back End:               PHP, Simple HTML DOM library
  * Technology:             RabbitMQ, MySQL, GIT,
  * Nutrition Data Source:  Nutritionix
 
 ## Getting Started ##
 
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. The repository is divided into 3 folders i.e. frontend, dmz, database. 
  
### Setting up ###

Followig will show the instructions on how to set up the files and listener files to test the website:

 * RabbitMQ:
   * Enable rabbitmq_management_plugin and start the RabbitMQ in the web browser.
   * Make two exchanges for the communication between front-end to database and database to dmz
     * First exchange: vh, e1 and q1
     * Second exchange: vh2, e2 and q2
 
 * Database:
   * Change /database/rabbitmqphp_example/testRabbitMQ.ini file and assign BROKER_HOST the IP address of RabbitMQ server
   * In terminal start /database/php/dbListner.php (this will start listening to RMQ messages)
   
 * DMZ:
   * Change /dmz/rabbitmqphp_example/testRabbitMQ.ini file and assign BROKER_HOST the IP address of RabbitMQ server
   * In terminal start /dmz/php/dbListner.php 
   
 * Front End:
   * Change /frontend/rabbitmqphp_example/testRabbitMQ.ini file and assign BROKER_HOST the IP address of RabbitMQ server
   * Open /frontedn/html/login.php in browser to begin testing
   
 ## Running the tests ##
 
  * Open sys-integration/frontend/html/login.php in browser for testing
  * Not yet member?:
    * Enter fields as specified to register a new user and then submit
    * Enter alergies if any and then submit
  * Login:
    * Login with the register email and password
  * Homepage:
    * Homepage has BMI setup
  * Search Page:
    * Enter a food name and then search
    * After search, a Box with picture of the product, and nutrition facts will appear.
  * Example:
    * To test the search, Insert Orange. 
    * Nutrition box with picture of an orange and nutrion facts will appear.
## Nutritionix ##
  * We would like to thank Nutritionix for providing us with API access free of use for this project.

## Authors ##

  * Shivam Gandhi- FrontEnd- skgandhi44
  * Milind Patel- Database- mrp72
  * Rushabh Patel- RabbitMQ- rdp48
  * Jay Patel- DMZ- jp772
## Acknowledgements ##
    
