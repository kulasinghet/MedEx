# alter id column to auto increment

# add foreign key to stock table medID column to medicine table id
# ALTER TABLE `stock` ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`medID`) REFERENCES `medicine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
# ALTER TABLE `stock` drop foreign key `stock_ibfk_2`;
# ALTER TABLE `stock` CHANGE `medId`
ALTER TABLE `pharmacy` modify `id` int(10) NOT NULL AUTO_INCREMENT;