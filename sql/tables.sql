CREATE TABLE Team (
  abb VARCHAR(3) NOT NULL,
  teamName VARCHAR(20) NOT NULL,
  conference CHAR(3),
  division VARCHAR(5),
  win INT NOT NULL,
  loss INT NOT NULL,
  tie INT NOT NULL,
  pct DOUBLE,
  PRIMARY KEY(abb)
);

CREATE TABLE Player (
  playerID INT NOT NULL AUTO_INCREMENT,
  fname VARCHAR(20) NOT NULL,
  lname VARCHAR(20) NOT NULL,
  position VARCHAR(3),
  team VARCHAR(3),
  playerNo INT NOT NULL,
  height INT,
  weight INT,
  amater VARCHAR(5),
  age INT,
  gplayed INT,
  PRIMARY KEY(playerID),
  FOREIGN KEY (team) references Team(abb)
);

CREATE TABLE Game (
  gameID INT NOT NULL AUTO_INCREMENT,
  weekNumber INT,
  team VARCHAR(3) ,
  home VARCHAR(3) ,
  away VARCHAR(3) ,
  homeScore INT NOT NULL,
  awayScore INT NOT NULL,
  PRIMARY KEY(gameID),
  FOREIGN KEY (team) REFERENCES Team(abb),
  FOREIGN KEY (home) REFERENCES Team(abb),
  FOREIGN KEY (away) REFERENCES Team(abb)
);

CREATE TABLE Rush(
  playerID INT NOT NULL AUTO_INCREMENT,
  attempts INT,
  yards INT,
  average DOUBLE,
  yardsPerGame DOUBLE,
  lng INT,
  touchdowns INT,
  firstDowns INT,
  PRIMARY KEY (playerID),
  FOREIGN KEY (playerID) REFERENCES Player(playerID)
);

CREATE TABLE Pass(
  playerID INT NOT NULL AUTO_INCREMENT,
  attempts INT,
  completions INT,
  percentage DOUBLE,
  yards INT,
  yardsPerAttempt DOUBLE,
  touchdowns INT,
  interceptions INT,
  sacks INT,
  rating DOUBLE,
  PRIMARY KEY (playerID),
  FOREIGN KEY (playerID) REFERENCES Player(playerID)
);

CREATE TABLE Recieve(
  playerID INT NOT NULL AUTO_INCREMENT,
  receptions INT,
  yards INT,
  average DOUBLE,
  yardsPerGame DOUBLE,
  touchdowns INT,
  firstDowns INT,
  yardsAfterCatch INT,
  PRIMARY KEY (playerID),
  FOREIGN KEY (playerID) REFERENCES Player(playerID)
);

CREATE TABLE Defence(
  playerID INT NOT NULL AUTO_INCREMENT,
  tackles INT,
  assisstedTackles INT,
  interceptions INT,
  interceptionYards INT,
  interceptionAverage DOUBLE,
  touchdowns INT,
  sacks DOUBLE,
  PRIMARY KEY (playerID),
  FOREIGN KEY (playerID) REFERENCES Player(playerID)
);

CREATE TABLE Kicking(
  playerID INT NOT NULL AUTO_INCREMENT,
  pat INT,
  fieldGoals INT,
  short INT,
  med INT,
  lng INT,
  points INT,
  PRIMARY KEY (playerID),
  FOREIGN KEY (playerID) REFERENCES Player(playerID)
);