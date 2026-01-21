DROP PROCEDURE IF EXISTS SP_UpdateVoorraad;
DELIMITER ??

CREATE PROCEDURE SP_UpdateVoorraad(
    IN p_productId INT,
    IN p_naam VARCHAR(255),
    IN p_barcode VARCHAR(50),
    IN p_houdbaarheidsdatum DATE,
    IN p_magazijnId INT,
    IN p_ontvangstdatum DATE,
    IN p_uitleveringsdatum DATE,
    IN p_aantal INT
)
BEGIN
    DECLARE v_magazijn_id INT;
    
    UPDATE Product
    SET 
        Naam = p_naam,
        Barcode = p_barcode,
        Houdbaarheidsdatum = p_houdbaarheidsdatum
    WHERE Id = p_productId;

    SELECT m.Id INTO v_magazijn_id
    FROM Magazijn m
    INNER JOIN ProductPerMagazijn ppm ON ppm.MagazijnId = m.Id
    WHERE ppm.ProductId = p_productId AND ppm.MagazijnId = p_magazijnId
    LIMIT 1;

    IF v_magazijn_id IS NOT NULL THEN
        UPDATE Magazijn
        SET 
            Ontvangstdatum = p_ontvangstdatum,
            Uitleveringsdatum = p_uitleveringsdatum,
            Aantal = p_aantal
        WHERE Id = v_magazijn_id;
    END IF;
END ??

DELIMITER ;
