BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "migrations" (
	"id"	integer NOT NULL,
	"migration"	varchar NOT NULL,
	"batch"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "users" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"email"	varchar NOT NULL,
	"email_verified_at"	datetime,
	"password"	varchar NOT NULL,
	"remember_token"	varchar,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "password_reset_tokens" (
	"email"	varchar NOT NULL,
	"token"	varchar NOT NULL,
	"created_at"	datetime,
	PRIMARY KEY("email")
);
CREATE TABLE IF NOT EXISTS "failed_jobs" (
	"id"	integer NOT NULL,
	"uuid"	varchar NOT NULL,
	"connection"	text NOT NULL,
	"queue"	text NOT NULL,
	"payload"	text NOT NULL,
	"exception"	text NOT NULL,
	"failed_at"	datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "personal_access_tokens" (
	"id"	integer NOT NULL,
	"tokenable_type"	varchar NOT NULL,
	"tokenable_id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"token"	varchar NOT NULL,
	"abilities"	text,
	"last_used_at"	datetime,
	"expires_at"	datetime,
	"created_at"	datetime,
	"updated_at"	datetime,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "serving_unit" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"size"	float NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "weight_unit" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"conversion_value"	float NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "height_unit" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"conversion_value"	float NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "user_health_details" (
	"id"	integer NOT NULL,
	"weight"	float,
	"height"	float,
	"bmi"	float,
	"bodyfat"	float,
	"last_updated"	datetime NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "user_health_logs" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"weight"	float,
	"height"	float,
	"bmi"	float,
	"bodyfat"	float,
	"time_updated"	datetime NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "user_configuration" (
	"id"	integer NOT NULL,
	"user_id"	integer NOT NULL,
	"weight_unit_id"	integer NOT NULL,
	"height_unit_id"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("weight_unit_id") REFERENCES "weight_unit"("id"),
	FOREIGN KEY("height_unit_id") REFERENCES "height_unit"("id")
);
CREATE TABLE IF NOT EXISTS "exercise_unit" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"short_name"	varchar,
	"base_value"	float NOT NULL,
	"unit_type_id"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "food_unit" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"short_name"	varchar,
	"base_value"	float NOT NULL,
	"unit_type_id"	integer NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "food_source" (
	"id"	INTEGER NOT NULL,
	"name"	TEXT NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "food" (
	"id"	integer NOT NULL,
	"name"	varchar NOT NULL,
	"user_id"	INTEGER NOT NULL,
	"source_id"	INTEGER NOT NULL,
	"created_at"	datetime,
	"updated_at"	datetime,
	"deleted_at"	datetime DEFAULT NULL,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "users"("id"),
	FOREIGN KEY("source_id") REFERENCES "food_source"("id")
);
CREATE TABLE IF NOT EXISTS "macronutrients" (
	"id"	integer NOT NULL,
	"food_id"	integer NOT NULL,
	"food_unit_id"	INTEGER NOT NULL,
	"serving_size"	float,
	"calories"	float,
	"fat"	float,
	"carbohydrates"	float,
	"protein"	float,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("food_unit_id") REFERENCES "food_unit"("id"),
	FOREIGN KEY("food_id") REFERENCES "food"("id")
);
CREATE TABLE IF NOT EXISTS "meal_items" (
	"id"	integer NOT NULL,
	"name"	varchar,
	"user_id"	INTEGER NOT NULL,
	"meal_id"	integer NOT NULL,
	"food_id"	integer NOT NULL,
	"food_unit_id"	integer NOT NULL,
	"created_at"	datetime NOT NULL,
	"updated_at"	datetime NOT NULL,
	"time_planned"	datetime NOT NULL,
	"quantity"	float,
	"serving_size"	integer NOT NULL,
	"is_eaten"	tinyint(1) NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("food_id") REFERENCES "food"("id"),
	FOREIGN KEY("food_unit_id") REFERENCES "food_unit"("id")
);
CREATE TABLE IF NOT EXISTS "meal" (
	"id"	INTEGER NOT NULL,
	"user_id"	INTEGER NOT NULL,
	"name"	TEXT NOT NULL,
	"time_planned"	datetime NOT NULL,
	"is_eaten"	tinyint(1) NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "users"("id")
);
INSERT INTO "migrations" VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO "migrations" VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO "migrations" VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO "migrations" VALUES (4,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO "migrations" VALUES (5,'2023_07_12_140209_create_mynutrition_database',2);
INSERT INTO "migrations" VALUES (9,'2023_07_12_142933_create_mynutrition_foreignkey_migrations',3);
INSERT INTO "migrations" VALUES (11,'2023_07_12_190547_create_unit_insertion',4);
INSERT INTO "migrations" VALUES (12,'2023_07_13_132152_create_mynutrition_database_ii',4);
INSERT INTO "users" VALUES (1,'FitnessAnon123','hildtgunnt@gmail.com',NULL,'$2y$10$nF506X7JMiygteL3q.jar.uOEpHa1yeo3zAz9QWgXwRxv5ezzqITG',NULL,'2023-07-08 01:17:27','2023-07-08 01:17:27');
INSERT INTO "serving_unit" VALUES (1,'100g',100.0);
INSERT INTO "serving_unit" VALUES (2,'g',1.0);
INSERT INTO "serving_unit" VALUES (3,'pc',1.0);
INSERT INTO "weight_unit" VALUES (1,'kilogram',1.0);
INSERT INTO "weight_unit" VALUES (2,'pound',2.20462);
INSERT INTO "weight_unit" VALUES (3,'stone',0.157473);
INSERT INTO "height_unit" VALUES (1,'centimeter',0.01);
INSERT INTO "height_unit" VALUES (2,'meter',1.0);
INSERT INTO "height_unit" VALUES (3,'inch',0.025);
INSERT INTO "height_unit" VALUES (4,'feet',0.3048);
INSERT INTO "exercise_unit" VALUES (1,'kilometre','km',1000.0,1);
INSERT INTO "exercise_unit" VALUES (2,'metre','m',1.0,1);
INSERT INTO "exercise_unit" VALUES (3,'mile','mi',1609.0,1);
INSERT INTO "food_unit" VALUES (1,'gram','g',1.0,1);
INSERT INTO "food_unit" VALUES (2,'pound','lb',454.0,1);
INSERT INTO "food_unit" VALUES (3,'kilogram','kg',1000.0,1);
INSERT INTO "food_unit" VALUES (4,'miligram','mg',0.001,1);
INSERT INTO "food_unit" VALUES (5,'piece','pc',1.0,2);
INSERT INTO "food_unit" VALUES (6,'slice','slice',1.0,2);
INSERT INTO "food_unit" VALUES (7,'tablespoon','tbsp',15.0,3);
INSERT INTO "food_unit" VALUES (8,'teaspoon','tsp',5.0,3);
INSERT INTO "food_unit" VALUES (9,'mililitre','ml',1.0,4);
INSERT INTO "food_unit" VALUES (10,'centilitre','cl',10.0,4);
INSERT INTO "food_unit" VALUES (11,'litre','l',1000.0,4);
INSERT INTO "food_source" VALUES (1,'Tesco');
INSERT INTO "food_source" VALUES (2,'Asda');
INSERT INTO "food_source" VALUES (3,'Subway');
INSERT INTO "food_source" VALUES (4,'Aldi');
INSERT INTO "food_source" VALUES (5,'Sainsburys');
INSERT INTO "food_source" VALUES (6,'Chicago Town');
INSERT INTO "food_source" VALUES (7,'Edge Cafe');
INSERT INTO "food_source" VALUES (8,'Kate');
INSERT INTO "food_source" VALUES (9,'Wing Brothers');
INSERT INTO "food_source" VALUES (10,'Waitrose');
INSERT INTO "food_source" VALUES (11,'Nutritionix');
INSERT INTO "food_source" VALUES (12,'Fatsecret');
INSERT INTO "food" VALUES (1,'Ricotta Cheese',1,4,'2023-07-20 04:50:49','2023-07-25 21:34:42',NULL);
INSERT INTO "food" VALUES (2,'Sweet Potato Fries',1,1,'2023-07-20 10:22:21','2023-07-26 11:37:54',NULL);
INSERT INTO "food" VALUES (3,'Wotsits Snack',1,1,'2023-07-20 10:30:20','2023-07-26 09:38:48',NULL);
INSERT INTO "food" VALUES (4,'Sweet Crispy Salad',1,5,'2023-07-20 10:30:20','2023-07-26 09:34:11',NULL);
INSERT INTO "food" VALUES (5,'Chicken Breast',1,1,'2023-07-20 10:51:25','2023-07-25 21:32:37',NULL);
INSERT INTO "food" VALUES (6,'Deep Dish Pizza',1,6,'2023-07-20 10:53:22','2023-07-20 10:53:22',NULL);
INSERT INTO "food" VALUES (7,'Margherita Pizza',1,1,'2023-07-20 10:55:50','2023-07-26 12:16:09',NULL);
INSERT INTO "food" VALUES (8,'Pepperoni Pizza',1,1,'2023-07-20 11:00:46','2023-07-26 12:15:44',NULL);
INSERT INTO "food" VALUES (9,'Sweet Chicken Pizza',1,1,'2023-07-20 11:03:30','2023-07-20 11:03:30',NULL);
INSERT INTO "food" VALUES (10,'Garlic Bread',1,1,'2023-07-20 11:05:46','2023-07-20 20:22:21',NULL);
INSERT INTO "food" VALUES (11,'Spaghetti',1,1,'2023-07-20 11:09:10','2023-07-26 11:53:44',NULL);
INSERT INTO "food" VALUES (12,'Bolognese Sauce',1,1,'2023-07-20 11:10:11','2023-07-20 11:10:11',NULL);
INSERT INTO "food" VALUES (13,'White Pasta Sauce',1,1,'2023-07-20 11:12:24','2023-07-20 11:12:24',NULL);
INSERT INTO "food" VALUES (14,'White Pasta Sauce',1,1,'2023-07-20 11:13:35','2023-07-20 11:13:35',NULL);
INSERT INTO "food" VALUES (15,'White Pasta Sauce',1,1,'2023-07-20 11:13:47','2023-07-20 11:13:47',NULL);
INSERT INTO "food" VALUES (16,'White Pasta Sauce',1,1,'2023-07-20 11:14:02','2023-07-20 11:14:02',NULL);
INSERT INTO "food" VALUES (17,'White Pasta Sauce',1,1,'2023-07-20 11:14:21','2023-07-20 11:14:21','');
INSERT INTO "food" VALUES (18,'Big Breakfast',1,7,'2023-07-21 12:08:39','2023-07-25 21:35:12',NULL);
INSERT INTO "food" VALUES (19,'Spinach Quiche',1,8,'2023-07-21 12:38:48','2023-07-21 12:38:48',NULL);
INSERT INTO "food" VALUES (20,'Mini Pork Pie',1,8,'2023-07-21 12:38:48','2023-07-25 21:34:59',NULL);
INSERT INTO "food" VALUES (21,'Toasted Waffles',1,8,'2023-07-21 12:38:48','2023-07-21 12:38:48',NULL);
INSERT INTO "food" VALUES (22,'Wing Brothers Meal',1,9,'2023-07-22 21:03:24','2023-07-25 11:08:42',NULL);
INSERT INTO "food" VALUES (23,'Diced Pancetta',1,10,'2023-07-24 04:12:36','2023-07-24 04:12:36',NULL);
INSERT INTO "food" VALUES (24,'Parmesan Cheese',1,10,'2023-07-24 04:12:36','2023-07-24 04:37:52',NULL);
INSERT INTO "food" VALUES (25,'Pecorino Romano',1,10,'2023-07-24 04:12:36','2023-07-24 04:12:36',NULL);
INSERT INTO "food" VALUES (26,'Stuffed Pepperoni Pizza',1,5,'2023-07-25 10:51:35','2023-07-25 10:51:35',NULL);
INSERT INTO "food" VALUES (27,'Garlic Herb Dip',1,5,'2023-07-25 10:53:15','2023-07-25 10:53:15',NULL);
INSERT INTO "food" VALUES (28,'Red Onion',1,11,'2023-07-25 10:54:31','2023-07-25 10:54:31',NULL);
INSERT INTO "food" VALUES (29,'Banana',1,5,'2023-07-25 14:20:39','2023-07-25 14:20:39',NULL);
INSERT INTO "food" VALUES (30,'Fried Chicken',1,12,'2023-07-25 20:55:11','2023-07-25 20:55:11',NULL);
INSERT INTO "food" VALUES (31,'French Fries',1,12,'2023-07-25 20:55:11','2023-07-25 20:55:11',NULL);
INSERT INTO "food" VALUES (32,'Egg Protein Pot',1,5,'2023-07-26 09:41:56','2023-07-26 09:41:56',NULL);
INSERT INTO "food" VALUES (33,'FGS Protein Shake',1,5,'2023-07-26 09:41:56','2023-07-26 09:41:56',NULL);
INSERT INTO "food" VALUES (34,'Thai Curry Sandwich',1,5,'2023-07-26 09:44:38','2023-07-26 09:44:38',NULL);
INSERT INTO "macronutrients" VALUES (1,1,1,100.0,99.0,6.3,3.3,7.1);
INSERT INTO "macronutrients" VALUES (2,2,1,100.0,320.0,18.2,32.4,3.9);
INSERT INTO "macronutrients" VALUES (3,3,1,16.5,82.0,5.3,7.6,0.9);
INSERT INTO "macronutrients" VALUES (4,4,1,100.0,54.0,3.3,3.8,0.8);
INSERT INTO "macronutrients" VALUES (5,5,1,100.0,159.0,2.4,0.7,33.7);
INSERT INTO "macronutrients" VALUES (6,6,1,155.0,418.0,16.0,50.0,16.0);
INSERT INTO "macronutrients" VALUES (7,7,1,100.0,335.0,9.5,4.4,17.4);
INSERT INTO "macronutrients" VALUES (8,8,1,100.0,401.0,17.4,41.4,18.0);
INSERT INTO "macronutrients" VALUES (9,9,1,155.0,348.0,7.3,52.2,17.1);
INSERT INTO "macronutrients" VALUES (10,10,1,26.0,109.0,6.0,11.5,2.1);
INSERT INTO "macronutrients" VALUES (11,11,1,100.0,174.0,0.6,36.1,5.5);
INSERT INTO "macronutrients" VALUES (12,12,1,NULL,39.0,0.7,6.0,1.5);
INSERT INTO "macronutrients" VALUES (13,13,1,100.0,95.0,7.8,4.1,1.9);
INSERT INTO "macronutrients" VALUES (14,14,1,NULL,95.0,7.8,4.1,1.9);
INSERT INTO "macronutrients" VALUES (15,15,1,NULL,95.0,7.8,4.1,1.9);
INSERT INTO "macronutrients" VALUES (16,16,1,NULL,95.0,7.8,4.1,1.9);
INSERT INTO "macronutrients" VALUES (17,17,1,NULL,95.0,7.8,4.1,1.9);
INSERT INTO "macronutrients" VALUES (18,18,1,100.0,1048.0,51.3,81.2,77.1);
INSERT INTO "macronutrients" VALUES (19,19,1,100.0,250.0,16.3,17.1,8.2);
INSERT INTO "macronutrients" VALUES (20,20,1,100.0,192.0,12.8,13.5,5.4);
INSERT INTO "macronutrients" VALUES (21,21,1,3.0,282.0,9.3,0.0,5.1);
INSERT INTO "macronutrients" VALUES (22,22,1,100.0,2000.0,80.0,120.0,90.0);
INSERT INTO "macronutrients" VALUES (23,23,1,77.0,318.0,29.2,11.7,13.3);
INSERT INTO "macronutrients" VALUES (24,24,1,100.0,397.0,29.7,0.0,32.4);
INSERT INTO "macronutrients" VALUES (25,25,1,100.0,392.0,32.0,0.0,26.0);
INSERT INTO "macronutrients" VALUES (26,26,1,100.0,275.0,10.7,30.8,13.1);
INSERT INTO "macronutrients" VALUES (27,27,1,100.0,626.0,68.7,1.2,0.5);
INSERT INTO "macronutrients" VALUES (28,28,1,94.0,41.0,0.2,9.5,1.3);
INSERT INTO "macronutrients" VALUES (29,29,1,100.0,89.0,0.3,23.0,1.1);
INSERT INTO "macronutrients" VALUES (30,30,1,100.0,297.0,18.8,16.3,15.6);
INSERT INTO "macronutrients" VALUES (31,31,1,100.0,274.0,14.1,35.7,3.5);
INSERT INTO "macronutrients" VALUES (32,32,1,90.0,127.0,8.2,1.2,12.0);
INSERT INTO "macronutrients" VALUES (33,33,1,475.0,214.0,1.3,25.0,25.0);
INSERT INTO "macronutrients" VALUES (34,34,1,217.0,396.0,13.0,46.4,21.7);
CREATE UNIQUE INDEX IF NOT EXISTS "users_email_unique" ON "users" (
	"email"
);
CREATE UNIQUE INDEX IF NOT EXISTS "failed_jobs_uuid_unique" ON "failed_jobs" (
	"uuid"
);
CREATE INDEX IF NOT EXISTS "personal_access_tokens_tokenable_type_tokenable_id_index" ON "personal_access_tokens" (
	"tokenable_type",
	"tokenable_id"
);
CREATE UNIQUE INDEX IF NOT EXISTS "personal_access_tokens_token_unique" ON "personal_access_tokens" (
	"token"
);
COMMIT;
