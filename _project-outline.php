<?php


## Models
- User
- Client
- Survey
- Section
- Question
- Answer
- Participant
- Response = pivot



## Migrations
User:
- client_id FK

Client:
- name
- type nullable
- street_address nullable
- city nullable
- country nullable
- postcode nullable

Survey:
- id ->from(2746)
- name
- type nullable (ask leanne for type options)
- client_id FK
- published_at nullable

Section:
- id->from(2746)
- name
- desciption nullable
- survey_id FK
- published_at nullable

Question:
- text
- desciption nullable
- type default 1-5 scale (can also be 1-7, 1-10 etc etc. If it is quiz, then it must have a correct answer)
- correct_answer nullable
- section_id FK
- published_at nullable

Answer:
- text
- description
- question_id FK
- published_at nullable

Participant:
- name nullable
- email required
- cohort int nullable
- team_id fk nullable
- client_id FK
- active boolean default y


participant_question:
- question_id
- participant_id
- text_response
- number_response
- created_at, updated at, deleted at

Teams:
- client_id

participant_survey:
- participant_id
- survey_id
- invite_hash
- invited_at
- completed_at
- timestamps



## Basic Relationships
A client hasMany users
A user belongsTo a client

A client hasMany surveys
A survey belongsTo a client

A client hasMany participants
A participant belongsTo a client

A client hasMany teams
A team belongsTo a client

A survey hasMany sections
A section belongsTo a survey

A survey belongsToMany participants
A participant belongsToMany surveys - pivot

A section hasMany questions
A question belongsTo a section


A question hasMany answers - as in options for an answer
An answer belongsTo a question

A question hasOne response
A response belongsTo a question

## Possible advanced queries with relationships
1. Get all surveys for a given client
2. Get all questions for a survey seperated into sections, with possible answers
3. Get all questions for a section
4. Get all participants for a given survey
5. get a given section with questions with answers for a participant
6 Get all questions with responses for a section
7. Store all responses to questions in a section

**/




// Public routes
/** Middleware to do this:

1. If a participant id and survey id is stored in session then things carry on

2. If they are not, AND a key is present then:
- use the key on the participant_survey table to find the particoant ID and the survey ID
- asuming a row exists, AND competed_at is empty, then send them to the show() method

3. If the completed_at is not empty, then redirect to survey done

4. If they are not uthorised (i.e there is no row correspindng to that key,
then they are shown a pretty 401)

**/
Route::get(
    '/start/22?access=ttt',
    ['ResponsesController::class', 'create']
);

/**
// index($section): view all responses
can be used to view all responses to a given survey.
1. Check for participant in Session
2. get the section with questions and answers
3. display them (possible pagination)

// create(): start a new response
Start a given survey
1. Find the participant & survey from the Session
2. Get participant with sections and questions
3. load the correct section view
(the latest one that's not completed)


// show($section)
Returns a section with questions
1. Get section
2. check that this is the latest section that's unanswered
3. return a view to that section


// store($section): store a set of responses
1. Find the participant from the session
2. Grab the $_POST data and store each question with answer
3. Mark section as completed
4. redorect to next section if they've not completed...
...or to the finsihed view if they are completed.


// edit($section): edit a response
1. Find the participant from the Session
2. Get participant where section = $section and questions
3. load that section
NOTE: this may not be needed - perhpas participants
shouldn't be able to edit a specific section
only be redorected to the latest one that's not completed

// update($section): update a response (or set of responses)
1. given a setion id and a response object
2. Update the questions_answers table
3. redirect to show



// destroy($section): delete a set of responses
1. find participant from session
2.
