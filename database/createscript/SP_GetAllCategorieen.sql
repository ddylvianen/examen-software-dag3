DROP TABLE IF EXISTS SP_GetAllCategorieen;
DELIMITER ??

CREATE PROCEDURE SP_GetAllCategorieen()
BEGIN
    SELECT
         c.id
        ,c.naam
    FROM Categorie c;
END ??

DELIMITER ;
