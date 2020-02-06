Halifax-Library-Management

Executive Summary:

Introduction: The Halifax Science Library (HSL) maintains an SQL database containing tables about various publications. HSL now wants to implement the following requirements: • To sell library Items Store transaction of sales of items in library. • Maintain records of all magazines, volumes and articles. • Record monthly expenses of HSL.

Approach: A Data model has been designed for HSL. Information about magazines, articles, customers, transactions and monthly expenses are stored. We started from creating ER/EER diagrams and continued to relational schema. All tables are normalized till 3NF as per the requirements. A file named articles. json has been extracted, transformation has been done using python scripts which are triggered by bash scripts. Thus, loading all information from source json file to MySQL tables. MVC application has been created from this data model through which we can see total number of tables available, create customer, create transaction, cancel transaction and much more. Data Requirements:

Existing tables: HSL personnel has already extracted and recorded in the SQL database some names and contact information of authors from available magazines. The Existing tables which we were provided are: • Author • Magazine • Item

New tables: We created new tables keeping in mind of the requirement’s and making a note of Discount code and transaction sum. After continuous brainstorming we arrived at some tables which are better for HSL to maintain. The new tables are: • Article • Author_list • Customer • Employee_monthly_expenses • Employees • Monthly_expenses • Master • Trans_cost • Trans_item • Transactions • Volume

Data to MongoDB: Description: The main objective of this task is to get relevant information from the source “articles.JSON” file that suits our MySQL tables. The file “articles.JSON” has the data regarding articles, authors and some useless data which must be cleaned to make this process easy. So, task is to write a BASH script which will trigger a python script that will clean up the “articles.json” file.

Data2mongo BASH Script: Algorithm: New Tables Creation: Initially the tables of the database are created and “new_tables.sql” file is executed by this BASH Script, which will connect to MySQL and executes our script “new_tables.sql” by using the database “project”.

Data Cleaning and creating Mongo collection: To get the relevant information from file “articles.json”, cleaning of the file must be done and as mentioned earlier BASH script triggers python script and cleans the “articles.json” file and creates the file “articles_clean.json” file, further this “articles_clean.json” has been imported as collection to mongoDB.

Mongo to SQL:

Description: The objective of this task is to load the data which we retrieved from 1 st BASH Script and loading the data into MySQL tables at required attributes. For this task we thought of two approaches where we can read the collections from mongoDB and import the data into MySQL tables at required constraints.

Approach 1: Initial approach is to read the collections from mongoDB, export the collections to intermediate result set called “Article.csv”. Then this result set is imported to MySQL tables using BASH script. This result set is imported to master table in database which is done by mongo2db BASH script. As trigger exists on the master table, for importing each record from csv file into the master table it gets segregated into specific tables as per set constraints.

Approach 2: Alternate approach for this exporting data into MySQL is to write a python script which will read both collections Author and Article, then exporting them to required tables in MySQL as per fields. This approach is solely depends on Python file.

Conclusion: If we use the second approach, while inserting each record form mongo collection to MYSQL tables, many validations must be done to make the record unique which creates a load on MYSQL and as well as for developer to validate all scenarios. Instead in approach 1, we created a master table in database and a trigger was written on it. So that all validations get done at the database side which makes job simple. As database is created with good constrained tables, it is easy to scaffold a table to views in PHP and handle the data. So, we went on with an PHP application. So, to conclude on the approaches and we proceeded with approach 1 for the web application as we considered that approach is more feasible for the application which eliminates redundancy and maintains referential integrity.

Appendix-A(References):

https://www.slideshare.net/brindamary/mapping-er-and-eer-model -- We went through this blog to refer how to represent schema.
