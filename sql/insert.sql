-- Insert every team roster into Player table where each roster is read from separate files per team
LOAD DATA LOCAL INFILE '~/Rosters/arizona.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘ARI’;
LOAD DATA LOCAL INFILE '~/Rosters/atlanta.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘ATL’;
LOAD DATA LOCAL INFILE '~/Rosters/baltimore.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘BAL’;
LOAD DATA LOCAL INFILE '~/Rosters/buffalo.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘BUF’;
LOAD DATA LOCAL INFILE '~/Rosters/chicago.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘CHI’;
LOAD DATA LOCAL INFILE '~/Rosters/cincinnati.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘CIN’;
LOAD DATA LOCAL INFILE '~/Rosters/cleveland.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘CLE’;
LOAD DATA LOCAL INFILE '~/Rosters/dallas.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘DAL’;
LOAD DATA LOCAL INFILE '~/Rosters/denver.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘DEN’;
LOAD DATA LOCAL INFILE '~/Rosters/detroit.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘DET’;
LOAD DATA LOCAL INFILE '~/Rosters/greenbay.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘GB’;
LOAD DATA LOCAL INFILE '~/Rosters/houston.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘HOU’;
LOAD DATA LOCAL INFILE '~/Rosters/indianapolis.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘IND’;
LOAD DATA LOCAL INFILE '~/Rosters/jacksonville.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘JAX’;
LOAD DATA LOCAL INFILE '~/Rosters/kansascity.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘KC’;
LOAD DATA LOCAL INFILE '~/Rosters/miami.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘MIA’;
LOAD DATA LOCAL INFILE '~/Rosters/minnesota.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘MIN’;
LOAD DATA LOCAL INFILE '~/Rosters/newengland.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘NE’;
LOAD DATA LOCAL INFILE '~/Rosters/neworleans.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘NO’;
LOAD DATA LOCAL INFILE '~/Rosters/giants.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘NYG’;
LOAD DATA LOCAL INFILE '~/Rosters/jets.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘NYJ’;
LOAD DATA LOCAL INFILE '~/Rosters/oakland.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘OAK’;
LOAD DATA LOCAL INFILE '~/Rosters/pittsburgh.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘PIT’;
LOAD DATA LOCAL INFILE '~/Rosters/sandiego.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘SD’;
LOAD DATA LOCAL INFILE '~/Rosters/sanfransico.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘SF’;
LOAD DATA LOCAL INFILE '~/Rosters/seattle.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘SEA’;
LOAD DATA LOCAL INFILE '~/Rosters/rams.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘STL’;
LOAD DATA LOCAL INFILE '~/Rosters/tampabay.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘TB’;
LOAD DATA LOCAL INFILE '~/Rosters/tennessee.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘TEN’;
LOAD DATA LOCAL INFILE '~/Rosters/washington.txt' INTO TABLE Player FIELDS TERMINATED BY ','
(playerNo, fname, lname, age, position, gplayed, @dummy, weight, height, amater, @dummy, @dummy, @dummy, @dummy, @dummy)
SET team = ‘WAS’;

-- Insert all passing players
LOAD DATA LOCAL INFILE '~/Positions/passing.txt' INTO TABLE Pass FIELDS TERMINATED BY ','
(@dummy, fname, lname, team, @dummy, @dummy, @dummy, @dummy, completions, attempts, percentage, yards, touchdowns, @dummy, interceptions, @dummy, @dummy, yardsPerAttempt, @dummy, @dummy, @dummy, rating, @dummy, sacks, @dummy, @dummy, @dummy, @dummy, @dummy, @dummy, @dummy);

-- Insert all rushing players
LOAD DATA LOCAL INFILE '~/Positions/rushing.txt' INTO TABLE Rush FIELDS TERMINATED BY ','
(@dummy, fname, lname, team, @dummy, @dummy, @dummy, attempts, yards, touchdowns, lng, average,yardsPerGame,@dummy, @dummy,@dummy,@dummy,@dummy,@dummy,@dummy,@dummy,@dummy,@dummy,@dummy,fumbles)

-- Insert all receiving players
LOAD DATA LOCAL INFILE '~/Positions/receiving.txt' INTO TABLE Receive FIELDS TERMINATED BY ','
(@dummy, fname, lname, team, @dummy, @dummy, @dummy, @dummy, receptions, yards, average, touchdowns, lng, @dummy, yardsPerGame, fumbles)


-- Add Primary Key
ALTER TABLE `assignment3`.`Recieve`
CHANGE COLUMN `playerID` `playerID` INT(11) NOT NULL ,
ADD PRIMARY KEY (`playerID`);

-- Add Foreign Key
ALTER TABLE Rush
ADD FOREIGN KEY (playerID)
REFERENCES Player(playerID)

-- Other Stuff
ARI,Arizona Cardinals,NFC,West,9,1,0,90.0
ATL,Atlanta Falcons,NFC,South,4,6,0,40.0
BAL,Baltimore Ravens,AFC,North,6,4,0,60.0
BUF,Buffalo Bills,AFC,North,5,5,0,50.0
CAR,Carolina Panthers,NFC,South,3,7,1,31.8
CHI,Chicago Bears,NFC,North,4,6,0,40.0
CIN,Cincinnati Bengals,AFC,North,6,3,1,65.0
CLE,Cleveland Browns,AFC,North,6,4,0,60.0
DAL,Dallas Cowboys,NFC,East,7,3,0,70.0
DEN,Denver Broncos,AFC,West,7,3,0,70.0
DET,Detroit Lions,NFC,North,7,3,0,70.0
GB,Green Bay Packers,NFC,North,7,3,0,70.0
HOU,Houston Texans ,AFC,South,5,5,0,50.0
IND,Indianapolis Colts,AFC,South,6,4,0,60.0
JAX,Jacksonville Jaguars,AFC,South,1,9,0,10.0
KC,Kansas City Chiefs,AFC,West,7,3,0,70.0
MIA,Miami Dolphins,AFC,East,6,4,0,60.0
MIN,Minnesota Vikings,NFC,North,4,6,0,40.0
NE,New England Patriots,AFC,East,8,2,0,80.0
NO,New Orleans Saints,NFC,South,4,6,0,40.0
NYG,New York Giants,NFC,East,3,7,0,30.0
NYJ,New York Jets,AFC,East,2,8,0,20.0
OAK,Oakland Raiders,AFC,West,0,10,0,0.0
PHI,Philadelphia Eagles,NFC,East,7,3,0,70.0
PIT,Pittsburgh Steelers,AFC,North,7,4,0,63.6
SD,San Diego Chargers,AFC,West,6,4,0,60.0
SF,San Francisco 49ers,NFC,West,6,4,0,60.0
SEA,Seattle Seahawks,NFC,West,6,4,0,60.0
STL,St. Louis Rams,NFC,West,4,6,0,40.0
TB, Tampa Bay Buccaneers,NFC,South,2,8,0,20.0
TEN,Tennessee Titans,AFC,South,2,8,0,20.0
WAS,Washington Redskins,NFC,East,3,7,0,30.0
NOR = NO
NWE = NE
GNB = GB
SFO = SF
TAM = TB
SDG = SD
KAN = KC

