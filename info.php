folder project must be inSIDE THE  xampp/htdocs/
 =====> 
 run iN BROWSER OR CHROME: http://localhost/php/index.php


1.start apache and mysql then go to admin in mysql

2.create DTABASE NAME :mydb

3.Create then table with name crud
        or maybe 
enter the sql query below 
  
CREATE TABLE `crud` (
  `id` int(11) NOT NULL,
  `prisonerName` varchar(255) NOT NULL,
  `case` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;  