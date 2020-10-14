/*code question 1- les 10 villes les plus peuplées en 2012*/
SELECT * 
FROM villes_france_free
ORDER BY ville_population_2012 DESC
LIMIT 10


/*code question 2*- les 50 villes ayant la plus faible superficie*/
SELECT * FROM villes_france_free
ORDER BY ville_surface ASC
LIMIT 50

/*code question 3*- les départements d’outre-mer, c’est-à-dire ceux dont le numéro de département commence par “97”*/
SELECT * FROM villes_france_free
WHERE ville_departement 
LIKE '97%' /* il faut les guillemets*/

/*code question 4*-le nom des 10 villes les plus peuplées en 2012, ainsi que le nom du département associé*/
SELECT * FROM villes_france_free 
LEFT JOIN departement ON departement_code = ville_departement
ORDER BY ville_population_2012 DESC 
LIMIT 10

/*code question 5*-les la liste du nom de chaque département, associé à son code et du nombre de commune 
au sein de ces départements, en triant afin d’obtenir en priorité les départements qui possèdent le plus de communes*/
SELECT departement_nom,departement_code FROM departement
LEFT JOIN COUNT()
