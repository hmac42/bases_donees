/*question 6 -  liste des 10 plus grands départements, en terme de
superficie*/

SELECT departement_nom,  SUM(`ville_surface`) AS dpt_surface 
FROM `villes_france_free` 
LEFT JOIN departement ON departement_code = ville_departement
GROUP BY departement_nom  
ORDER BY dpt_surface  DESC
LIMIT 10

/* question 7 - compter le nombre de villes dont le nom commence par “Saint”*/

SELECT COUNT(ville_nom) 
FROM villes_france_free
WHERE ville_nom LIKE 'saint%'

/*question 8 - liste des villes qui ont un nom existants plusieurs fois, et
trier afin d’obtenir en premier celles dont le nom est le plus souvent utilisé par plusieurs communes
*/
SELECT ville_nom, COUNT(*) AS nbt_item 
FROM `villes_france_free` 
GROUP BY `ville_nom` 
ORDER BY nbt_item DESC

/*question 9 -  liste des villes dont la
superficie est supérieure à la superficie moyenne*/
SELECT * FROM villes_france_free
WHERE ville_surface >= (SELECT AVG(ville_surface)
FROM villes_france_free)

/* question 9 - liste des départements qui possèdent plus de 2
millions d’habitants*/

SELECT ville_departement, SUM(`ville_population_2012`) AS population_2012
FROM `villes_france_free` 
GROUP BY `ville_departement`
HAVING population_2012 > 2000000
ORDER BY population_2012 DESC /*bonne solution*/

SELECT departement_nom , SUM(ville_population_2012) AS nbr_item
FROM villes_france_free
LEFT JOIN DEPARTEMENT ON departement_code = ville_departement
GROUP BY departement_nom
HAVING nbr_item > 2000000
ORDER BY nbr_item desc

