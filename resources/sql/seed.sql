DROP SCHEMA public CASCADE;
CREATE SCHEMA public;

GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO public;

CREATE TYPE changes AS ENUM (
    'Location',
    'Date',
    'Name'
);

CREATE TYPE roles AS ENUM (
    'Participant',
    'Manager',
    'Owner'
);

CREATE TYPE status AS ENUM (
    'Going',
    'Interested',
    'NotGoing'
);

CREATE TYPE visibilities AS ENUM (
    'Private',
    'Public'
);

CREATE TABLE event (
    id SERIAL NOT NULL,
    title character varying(128) NOT NULL,
    date timestamp without time zone NOT NULL,
    location character varying(128) NOT NULL,
    description text,
    image character varying(256),
    visibility visibilities NOT NULL,
    CONSTRAINT event_pkey PRIMARY KEY (id)
);

CREATE TABLE country (
    id SERIAL NOT NULL,
    name character varying(64) NOT NULL,
    CONSTRAINT country_country_key UNIQUE (name),
    CONSTRAINT country_pkey PRIMARY KEY (id)
);

CREATE TABLE member (
    id serial NOT NULL,
    name character varying(64) NOT NULL,
    password character varying(128) NOT NULL,
    description text,
    contact character varying(20),
    image character varying,
    email character varying(254) NOT NULL,
    birthdate date,
    age smallint,
    admin boolean DEFAULT false NOT NULL,
    id_country integer,
    remember_token character varying,
    CONSTRAINT member_pkey PRIMARY KEY (id),
    CONSTRAINT member_id_county_fkey FOREIGN KEY (id_country) REFERENCES country(id)
);

CREATE TABLE blocked (
    id SERIAL NOT NULL,
    id_event integer NOT NULL,
    id_member integer NOT NULL,
    CONSTRAINT blocked_pkey PRIMARY KEY (id),
    CONSTRAINT blocked_id_event_fkey FOREIGN KEY (id_event) REFERENCES event(id) ON DELETE CASCADE,
    CONSTRAINT blocked_id_member_fkey FOREIGN KEY (id_member) REFERENCES member(id) ON DELETE CASCADE
);

CREATE TABLE comment (
    id SERIAL NOT NULL,
    id_member integer NOT NULL,
    id_event integer NOT NULL,
    date timestamp without time zone NOT NULL,
    CONSTRAINT comment_pkey PRIMARY KEY (id),
    CONSTRAINT comment_id_event_fkey FOREIGN KEY (id_event) REFERENCES event(id) ON DELETE CASCADE,
    CONSTRAINT comment_id_member_fkey FOREIGN KEY (id_member) REFERENCES member(id) ON DELETE CASCADE
);
    
CREATE TABLE notification (
    id SERIAL NOT NULL,
    id_member integer NOT NULL,
    seen boolean DEFAULT false NOT NULL,
    hidden boolean DEFAULT false NOT NULL,
    CONSTRAINT notification_pkey PRIMARY KEY (id),
    CONSTRAINT notification_id_member_fkey FOREIGN KEY (id_member) REFERENCES member(id) ON DELETE CASCADE
);

CREATE TABLE event_change (
    id_notification integer NOT NULL,
    id_event integer NOT NULL,
    change changes NOT NULL,
    CONSTRAINT event_change_pkey PRIMARY KEY (id_notification),
    CONSTRAINT event_change_id_event_fkey FOREIGN KEY (id_event) REFERENCES event(id) ON DELETE CASCADE,
    CONSTRAINT event_change_id_notification_fkey FOREIGN KEY (id_notification) REFERENCES notification(id)
);

CREATE TABLE event_invitation (
    id_notification integer NOT NULL,
    id_event integer NOT NULL,
    CONSTRAINT event_invitation_pkey PRIMARY KEY (id_notification),
    CONSTRAINT event_invitation_id_event_fkey FOREIGN KEY (id_event) REFERENCES event(id) ON DELETE CASCADE,
    CONSTRAINT event_invitation_id_notification_fkey FOREIGN KEY (id_notification) REFERENCES notification(id)
);

CREATE TABLE event_member (
    id SERIAL NOT NULL,
    id_event integer NOT NULL,
    id_member integer NOT NULL,
    role roles NOT NULL,
    status status,
    CONSTRAINT event_member_pkey PRIMARY KEY (id),
    CONSTRAINT event_member_id_event_fkey FOREIGN KEY (id_event) REFERENCES event(id) ON DELETE CASCADE,
    CONSTRAINT event_member_id_member_fkey FOREIGN KEY (id_member) REFERENCES member(id) ON DELETE CASCADE
);

CREATE TABLE tag (
    name character varying(30) NOT NULL,
    CONSTRAINT tag_pkey PRIMARY KEY (name)
);

CREATE TABLE event_tags (
    id SERIAL NOT NULL,
    id_event integer NOT NULL,
    name_tag character varying(30) NOT NULL,
    CONSTRAINT event_tags_pkey PRIMARY KEY (id),
    CONSTRAINT event_tags_id_event_fkey FOREIGN KEY (id_event) REFERENCES event(id) ON DELETE CASCADE,
    CONSTRAINT event_tags_name_tag_fkey FOREIGN KEY (name_tag) REFERENCES tag(name)
);

CREATE TABLE file (
    id_comment integer NOT NULL,
    path character varying(4096) NOT NULL,
    text character varying(240),
    CONSTRAINT file_pkey PRIMARY KEY (id_comment),
    CONSTRAINT file_id_comment_fkey FOREIGN KEY (id_comment) REFERENCES comment(id) ON DELETE CASCADE
);

CREATE TABLE friend (
    id SERIAL NOT NULL,
    id_member integer NOT NULL,
    id_friend integer NOT NULL,
    CONSTRAINT friend_pkey PRIMARY KEY (id),
    CONSTRAINT friend_id_friend_fkey FOREIGN KEY (id_friend) REFERENCES member(id) ON DELETE CASCADE,
    CONSTRAINT friend_id_member_fkey FOREIGN KEY (id_member) REFERENCES member(id) ON DELETE CASCADE
);

CREATE TABLE friend_request (
    id_notification integer NOT NULL,
    id_member integer NOT NULL,
    CONSTRAINT friend_request_pkey PRIMARY KEY (id_notification),
    CONSTRAINT friend_request_id_member_fkey FOREIGN KEY (id_member) REFERENCES member(id) ON DELETE CASCADE,
    CONSTRAINT friend_request_id_notification_fkey FOREIGN KEY (id_notification) REFERENCES notification(id)
);

CREATE TABLE liked (
    id SERIAL NOT NULL,
    id_member integer NOT NULL,
    id_comment integer NOT NULL,
    CONSTRAINT liked_pkey PRIMARY KEY (id),
    CONSTRAINT liked_id_comment_fkey FOREIGN KEY (id_comment) REFERENCES comment(id) ON DELETE CASCADE,
    CONSTRAINT liked_id_member_fkey FOREIGN KEY (id_member) REFERENCES member(id) ON DELETE CASCADE,
    CONSTRAINT liked_id_member_id_comment_key UNIQUE (id_member, id_comment)
);

CREATE TABLE member_tags (
    id SERIAL NOT NULL,
    id_member integer NOT NULL,
    name_tag character varying(30) NOT NULL,
    CONSTRAINT member_tags_pkey PRIMARY KEY (id),
    CONSTRAINT member_tags_id_member_fkey FOREIGN KEY (id_member) REFERENCES member(id) ON DELETE CASCADE,
    CONSTRAINT member_tags_name_tag_fkey FOREIGN KEY (name_tag) REFERENCES tag(name)
);

CREATE TABLE option (
    id SERIAL NOT NULL,
    option_text character varying NOT NULL,
    id_comment integer NOT NULL,
    CONSTRAINT option_pkey PRIMARY KEY (id),
    CONSTRAINT option_id_comment_fkey FOREIGN KEY (id_comment) REFERENCES comment(id) ON DELETE CASCADE
);

CREATE TABLE poll (
    id_comment integer NOT NULL,
    text character varying(240) NOT NULL,
    CONSTRAINT poll_pkey PRIMARY KEY (id_comment),
    CONSTRAINT poll_id_comment_fkey FOREIGN KEY (id_comment) REFERENCES comment(id) ON DELETE CASCADE
);

CREATE TABLE text_comment (
    id_comment integer NOT NULL,
    id_parent integer,
    text character varying(240) NOT NULL,
    CONSTRAINT text_comment_pkey PRIMARY KEY (id_comment),
    CONSTRAINT text_comment_id_comment_fkey FOREIGN KEY (id_comment) REFERENCES comment(id) ON DELETE CASCADE,
    CONSTRAINT text_comment_id_parent_fkey FOREIGN KEY (id_parent) REFERENCES comment(id) ON DELETE CASCADE
);

CREATE TABLE vote (
    id SERIAL NOT NULL,
    id_member integer NOT NULL,
    id_option integer NOT NULL,
    CONSTRAINT vote_pkey PRIMARY KEY (id),
    CONSTRAINT vote_id_member_fkey FOREIGN KEY (id_member) REFERENCES member(id) ON DELETE CASCADE,
    CONSTRAINT vote_id_option_fkey FOREIGN KEY (id_option) REFERENCES option(id) ON DELETE CASCADE
);

CREATE INDEX members ON member USING hash(id);

CREATE INDEX events ON event USING hash(id);

CREATE INDEX event_comments ON comment USING hash(id_event);

CREATE INDEX member_friends ON friend USING hash(id_member);

CREATE INDEX member_events ON event_member USING hash(id_member);

CREATE INDEX search_event ON event USING GIST (to_tsvector('english', title));

CREATE FUNCTION calculate_age() RETURNS TRIGGER AS
$BODY$
BEGIN
  NEW.age = date_part('year', age(NEW.birthdate));
  RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER calculate_age
  BEFORE INSERT OR UPDATE ON member
  FOR EACH ROW
    EXECUTE PROCEDURE calculate_age(); 

CREATE FUNCTION clear_choice() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF EXISTS (
    SELECT old_vote.id_option FROM
    vote as old_vote,
    option as old_option,
    option as new_option
    WHERE NEW.id_member = old_vote.id_member
    AND old_vote.id_option = old_option.id
    AND NEW.id_option = new_option.id
    AND old_option.id_comment = new_option.id_comment) THEN
  DELETE FROM vote WHERE vote.id_member = NEW.id_member AND vote.id_option = (SELECT old_vote.id_option FROM
    vote as old_vote,
    option as old_option,
    option as new_option
    WHERE NEW.id_member = old_vote.id_member
    AND old_vote.id_option = old_option.id
    AND NEW.id_option = new_option.id
    AND old_option.id_comment = new_option.id_comment);
  END IF;
  RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER clear_choice
  BEFORE INSERT ON vote
  FOR EACH ROW
    EXECUTE PROCEDURE clear_choice();