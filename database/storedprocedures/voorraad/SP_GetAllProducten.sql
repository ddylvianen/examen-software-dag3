DROP PROCEDURE IF EXISTS SP_GetAllProducten;
DELIMITER ??

CREATE PROCEDURE SP_GetAllProducten()
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
        p.IsActief = 1
        AND ppm.IsActief = 1
        AND m.IsActief = 1
        AND p.CategorieId = categorieId
    ORDER BY
        p.Naam ASC;
END ??

DELIMITER ;
