# MU-Checker for Wordpress Multisite
Use this small script to find ghost blogs.dir folders and ghost blogs tables.
## The issue
Each time you delete a site in a WordPress Multisite installation, its tables and folders are not deleted. If you manage a lot of websites, made many tests sites you deleted, etc. then your database and folders may need to be cleaned.
### Why should I clean these ghost elements ?
1. to keep your installation clean and readable when you have to look into it
2. your backup files will be lighter
3. backups may spend less time to perform, depending on the size of all deleted ghost elements

## Usage
1. upload the [mu-checker.php](mu-checker.php) at the root of your website
2. visit /mu-checker.php with your browser
3. a list of ghost folders found in wp-content/blogs.dir and a list of ghost tables found in your database are displayed
4. manually delete folders and tables you don't want to keep
5. don't forget to delete the file after using it

##FAQ
### How does it work ?
MU-Checker loads the WordPress framework and use it to access your database. It finds the actual existing websites ids and compares them with what folders are in your blogs.dir directory and then compares with the table existing in your database. That's all !
### How safe is it ?
MU-Checker does only show you what table and folders could be deleted. It doesn't do any other operation else as you have to delete ghost elements manually.
