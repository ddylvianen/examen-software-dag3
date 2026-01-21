DROP PROCEDURE IF EXISTS SP_GetProductenInfoById;
DELIMITER ??

CREATE PROCEDURE SP_GetProductenInfoById(
    IN p_productId INT
)
BEGIN
    SELECT
        p.Id                         AS product_id,
        p.Naam                       AS productnaam,
        p.Houdbaarheidsdatum         AS houdbaarheidsdatum,
        p.Barcode                    AS barcode,
        ppm.Locatie                  AS magazijn,
        m.Id                         AS magazijn_id,
        ppm.MagazijnId               AS magazijn_relatie_id,
        m.Ontvangstdatum             AS ontvangstdatum,
        m.Uitleveringsdatum          AS uitleveringsdatum,
        m.Aantal                     AS aantal
    FROM Product p
    JOIN ProductPerMagazijn ppm
        ON ppm.ProductId = p.Id
    JOIN Magazijn m
        ON m.Id = ppm.MagazijnId
    WHERE
        p.id = p_productId
    ORDER BY
        p.Naam ASC;
END ??

DELIMITER ;

