CREATE DATABASE IF NOT EXISTS `veloworld` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `veloworld`;

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) CHARACTER SET utf8mb3 NOT NULL,
  `colour` varchar(100) CHARACTER SET utf8mb3 DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `items` (`id`, `item_name`, `colour`, `description`, `price`, `quantity`, `image`) VALUES
(1, 'City Bike 1', 'Blue', 'Comfortable and practical city bike designed for everyday commuting. Lightweight frame, smooth gears, and upright riding position make it perfect for navigating urban streets with ease.', 500.00, 5, 'images/items/stock/city_bike_1.jpg'),
(2, 'Road Bike 1', 'Black', 'Lightweight and aerodynamic road bike designed for speed and efficiency on paved roads. Smooth shifting, responsive handling, and comfortable geometry make it perfect for long rides and daily training.', 2899.00, 5, 'images/items/stock/road_bike_1.jpg'),
(3, 'Mountain Bike 1', 'Black', 'Durable and versatile mountain bike built for off-road trails. Featuring strong suspension, grippy tyres, and reliable gearing, it’s perfect for rugged terrain and adventurous rides.', 670.00, 5, 'images/items/stock/mountain_bike_1.jpg'),
(4, 'Mountain Bike 2', 'Silver', 'Robust and trail-ready mountain bike designed to handle challenging landscapes. Equipped with responsive suspension, wide traction tyres, and smooth shifting, it delivers control and confidence on every off-road adventure.', 1200.00, 3, 'images/items/stock/mountain_bike_2.jpg'),
(5, 'Triathlon Bike 1', 'Blue', 'Aerodynamic and performance-focused triathlon bike built for speed and endurance. Lightweight frame, aggressive geometry, and precision components help riders maintain optimal positioning and power output during long-distance races.', 6000.00, 2, 'images/items/stock/triathlon_bike_1.jpg'),
(6, 'City Bike 2', 'Red', 'Reliable and efficient commuter bike created for daily travel around town. Designed with a sturdy frame, easy-shifting gears, and a relaxed riding position, it ensures smooth and enjoyable journeys through busy city roads.', 200.00, 2, 'images/items/stock/city_bike_2.jpg'),
(7, 'Road Bike 2', 'Blue', 'High-performance road bike crafted for fast-paced rides and competitive cycling. Featuring a sleek frame, precise gear transitions, and agile steering, it offers excellent power transfer and comfort over extended distances.', 900.00, 2, 'images/items/stock/road_bike_2.jpg'),
(8, 'Electric Bike 1', 'Green', 'Modern electric bike built for effortless riding. Features a powerful motor, long-lasting battery, and comfortable frame, making it ideal for commuting, leisure rides, and tackling hills with ease.', 1450.00, 7, 'images/items/stock/electric_bike_1.jpg');

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb3 NOT NULL,
  `surname` varchar(128) CHARACTER SET utf8mb3 NOT NULL,
  `item` varchar(128) CHARACTER SET utf8mb3 DEFAULT NULL,
  `review` text CHARACTER SET utf8mb3 NOT NULL,
  `rating` int NOT NULL DEFAULT '0',
  `inserted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `reviews` (`id`, `name`, `surname`, `item`, `review`, `rating`, `inserted_at`) VALUES
(1, 'Charles', 'Rodgers', 'Road Bike 1', 'Good service and quality.', 4, '2025-12-09 19:38:49'),
(2, 'Jane', 'Ballard', 'Mountain Bike 2', 'Good customer service and high quality.', 5, '2025-12-10 11:25:32'),
(3, 'Elizabeth', 'Edwards', 'City Bike 1', 'The city bike was very expensive compared to other sites and the quality was not excellent.', 2, '2025-12-17 15:13:28');

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb3 DEFAULT NULL,
  `email` varchar(128) CHARACTER SET utf8mb3 DEFAULT NULL,
  `password` varchar(128) CHARACTER SET utf8mb3 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', '1234@admin.com', '$2y$10$nEtBpbn/ZgflaKM1AMKRJe9z9oOgxpRrcn6EJuESNohd/IJG.m1/m');