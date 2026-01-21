DROP TABLE IF EXISTS SP_GetProductenPerCategorie;
DELIMITER ??

CREATE PROCEDURE SP_GetProductenPerCategorie(
    IN p_categorieId INT
)
BEGIN
    SELECT
        p.Id                         AS product_id,
        p.Naam                       AS productnaam,
        c.Naam                       AS categorie,
        m.VerpakkingsEenheid         AS eenheid,
        m.Aantal                     AS aantal,
        p.Houdbaarheidsdatum         AS houdbaarheidsdatum,
        ppm.Locatie                  AS magazijn
    FROM Product p
    JOIN Categorie c
        ON c.Id = p.CategorieId
    JOIN ProductPerMagazijn ppm
        ON ppm.ProductId = p.Id
    JOIN Magazijn m
        ON m.Id = ppm.MagazijnId
    WHERE
        p.categorieId = p_categorieId
    ORDER BY
        p.Naam ASC;
END ??

DELIMITER ;
