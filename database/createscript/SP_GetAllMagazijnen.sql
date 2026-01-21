DROP PROCEDURE IF EXISTS SP_GetAllMagazijnen;
DELIMITER ??

CREATE PROCEDURE SP_GetAllMagazijnen()
BEGIN
    SELECT DISTINCT
        ppm.Locatie
    FROM ProductPerMagazijn ppm
    ORDER BY ppm.Locatie;
END ??

DELIMITER ;
