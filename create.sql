#table with all questions, answers, date of the question and so on
create table questions(
idnr int,
mnr varchar(20),
email varchar(200),
date varchar(200),
questionnr int,
responder varchar(20),
course varchar(200),
chapter int,
stars varchar(20),
question longtext,
answer longtext,
time varchar(20),
busy int,
images int,
files int
);

#structure of each course. A course can have parts, each part has chapters
create table chapters(
chapterid int,
course varchar(20),
year int,
part int,
title varchar(200),
parttitle varchar(200)
);

#people who are allowed to answer questions. roles are all the courses they are involved
#this is not the orginal table structure, the data has already been transformed a bit
create table team(
name varchar(200),
unr varchar(20),
email varchar(200),
course varchar(20),
monitor int,
id int,
roles varchar(200)
);