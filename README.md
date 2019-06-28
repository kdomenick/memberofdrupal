# memberofdrupal
Check Drupal 8 account access without having an admin login (For special use cases.  See README.) 

Use case:  A non-Drupal admin has the need to check if a User account exists within a Drupal site.  This could be a first-line support tech or help desk person who just needs to confirm if an account exists, but for various reasons, may not have their own account to log in and check this information.  

This could have security implications if used improperly.  Proceed with caution.

Instructions:
1. Move files to your web server 
2. Modify yourdbconnectionfile.php to contain your own database values.  You can move this out of the same directory as memberof.php, as long as you adjust the require statement to reflect the new location.
3. Modify memberof.php to adjust the SQL statement to search for and display field values from your user account.  In the example, there 
are three custom fields on the user account: first name, last name, and home department.  
4. Modify usersimplified.sql to match whatever field values you have on your user account.  
5. Run usersimplified.sql against your database to create the view.
6. Load memberof.php in a browser and try searching
