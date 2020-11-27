## Databases Final Project - Canada Cars

### Necessary tools for use
- MySQL Workbench
- a localhost server (WAMP is used for this project)

### In MySQL Workbench
1. Place this repository in your server's project folder (../www for WAMP server)
2. Create a new connection with the host name as localhost and the port as the port number set for MySQL on your localhost server, (for us it was port 3306)
3. Execute the create queries in car_rental database/schema and tables in the following order: 'create car_rental database.sql', 'car table.sql', 'client table.sql', 'location table.sql', 'order_details table.sql', 'stored_in.sql'
4. Then import the CSV files in car_rental database/sample data in the following order in their respective tables: 'cars.csv', client.csv', 'locations.csv', 'orders.csv', 'stored_in.csv'
5. Create a new user called 'admin' with the password 'password' and grant it all privileges in the car_rental database
6. Start your localhost server and run welcomePage.php on your browser to use
