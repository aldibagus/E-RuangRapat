/*
 Navicat Premium Data Transfer

 Source Server         : Development Server - PostgreSQL
 Source Server Type    : PostgreSQL
 Source Server Version : 120004
 Source Host           : dev-server:5432
 Source Catalog        : madiungov
 Source Schema         : ruangrapat

 Target Server Type    : PostgreSQL
 Target Server Version : 120004
 File Encoding         : 65001

 Date: 13/09/2020 21:40:08
*/


-- ----------------------------
-- Table structure for guest
-- ----------------------------
DROP TABLE IF EXISTS "ruangrapat"."guest" CASCADE;
CREATE TABLE "ruangrapat"."guest" (
  "id" serial4 NOT NULL,
  "email" varchar(50) NOT NULL,
  "fullname" varchar(100)
)
;

-- ----------------------------
-- Records of guest
-- ----------------------------

-- ----------------------------
-- Table structure for meeting
-- ----------------------------
DROP TABLE IF EXISTS "ruangrapat"."meeting" CASCADE;
CREATE TABLE "ruangrapat"."meeting" (
  "id" serial4 NOT NULL,
  "booked_by_user" varchar(30),
  "booked_by_guest" int4,
  "email" varchar(100),
  "opd" varchar(100),
  "room" int4 NOT NULL,
  "meeting_leader" varchar(50),
  "meeting_title" varchar(50) NOT NULL,
  "meeting_participant" int2 NOT NULL,
  "start_time" timestamp(6) NOT NULL,
  "finish_time" timestamp(6) NOT NULL,
  "description" text,
  "supporting_file" varchar(20),
  "notes" varchar(100),
  "accepted" bool,
  "accepted_by" varchar(30)
)
;

-- ----------------------------
-- Records of meeting
-- ----------------------------

-- ----------------------------
-- Table structure for opd
-- ----------------------------
DROP TABLE IF EXISTS "ruangrapat"."opd" CASCADE;
CREATE TABLE "ruangrapat"."opd" (
  "id" serial4 NOT NULL,
  "name" varchar(255) NOT NULL
)
;

-- ----------------------------
-- Records of opd
-- ----------------------------
INSERT INTO "ruangrapat"."opd" VALUES (nextval('ruangrapat.opd_id_seq'), 'Badan Kepegawaian Daerah');
INSERT INTO "ruangrapat"."opd" VALUES (nextval('ruangrapat.opd_id_seq'), 'Badan Kesatuan Bangsa dan Politik');
INSERT INTO "ruangrapat"."opd" VALUES (nextval('ruangrapat.opd_id_seq'), 'Badan Penanggulangan Bencana Daerah');
INSERT INTO "ruangrapat"."opd" VALUES (nextval('ruangrapat.opd_id_seq'), 'Badan Pendapatan Daerah');
INSERT INTO "ruangrapat"."opd" VALUES (nextval('ruangrapat.opd_id_seq'), 'Badan Pengelolaan Keuangan dan Aset Daerah');

-- ----------------------------
-- Table structure for room
-- ----------------------------
DROP TABLE IF EXISTS "ruangrapat"."room" CASCADE;
CREATE TABLE "ruangrapat"."room" (
  "id" serial4 NOT NULL,
  "parent_id" int4,
  "name" varchar(50) NOT NULL,
  "capacity" int4 NOT NULL DEFAULT 0
)
;

-- ----------------------------
-- Records of room
-- ----------------------------
INSERT INTO "ruangrapat"."room" VALUES (nextval('ruangrapat.room_id_seq'), NULL, 'A', 80);
INSERT INTO "ruangrapat"."room" VALUES (nextval('ruangrapat.room_id_seq'), 1, 'A1', 40);
INSERT INTO "ruangrapat"."room" VALUES (nextval('ruangrapat.room_id_seq'), 1, 'A2', 40);
INSERT INTO "ruangrapat"."room" VALUES (nextval('ruangrapat.room_id_seq'), NULL, 'B', 25);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS "ruangrapat"."user" CASCADE;
CREATE TABLE "ruangrapat"."user" (
  "id" varchar(30) NOT NULL,
  "email" varchar(50),
  "fullname" varchar(100) NOT NULL,
  "username" varchar(50) NOT NULL,
  "password" char(60) NOT NULL,
  "opd" int4,
  "is_admin" bool NOT NULL
)
;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO "ruangrapat"."user" VALUES ('0000000000000001', 'admin@example.com', 'Administrator', 'admin', '$2y$10$YbtRLCXfT.A4cCUpsd55Z.rBZIZyw5OqrKuWtkTIVW3rXbAnvnff.', NULL, 't');
INSERT INTO "ruangrapat"."user" VALUES ('0000000000000002', 'kamil@example.com', 'Kamil', 'kamil', '$2y$10$OSGu5FLObVFW/3tIpi00FO13klDQyAga9ENaxneNj7ms2RPAZEib2', NULL, 'f');

-- ----------------------------
-- Indexes structure for table guest
-- ----------------------------
CREATE UNIQUE INDEX "guest_email_key" ON "ruangrapat"."guest" USING btree (
  "email" "pg_catalog"."text_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table guest
-- ----------------------------
ALTER TABLE "ruangrapat"."guest" ADD CONSTRAINT "guest_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table meeting
-- ----------------------------
CREATE INDEX "meeting_finish_time_idx" ON "ruangrapat"."meeting" USING btree (
  "finish_time" "pg_catalog"."timestamp_ops" ASC NULLS LAST
);
CREATE INDEX "meeting_start_time_idx" ON "ruangrapat"."meeting" USING btree (
  "start_time" "pg_catalog"."timestamp_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table meeting
-- ----------------------------
ALTER TABLE "ruangrapat"."meeting" ADD CONSTRAINT "meeting_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table opd
-- ----------------------------
ALTER TABLE "ruangrapat"."opd" ADD CONSTRAINT "opd_name_key" UNIQUE ("name");

-- ----------------------------
-- Primary Key structure for table opd
-- ----------------------------
ALTER TABLE "ruangrapat"."opd" ADD CONSTRAINT "opd_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table room
-- ----------------------------
ALTER TABLE "ruangrapat"."room" ADD CONSTRAINT "room_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table user
-- ----------------------------
CREATE UNIQUE INDEX "user_username_key" ON "ruangrapat"."user" USING btree (
  "username" "pg_catalog"."text_ops" ASC NULLS LAST
);

-- ----------------------------
-- Uniques structure for table user
-- ----------------------------
ALTER TABLE "ruangrapat"."user" ADD CONSTRAINT "user_email_key" UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table user
-- ----------------------------
ALTER TABLE "ruangrapat"."user" ADD CONSTRAINT "user_pkey" PRIMARY KEY ("id");
ALTER TABLE "ruangrapat"."user" ADD CONSTRAINT "fk_user_opd_1" FOREIGN KEY ("opd") REFERENCES "ruangrapat"."opd" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table meeting
-- ----------------------------
ALTER TABLE "ruangrapat"."meeting" ADD CONSTRAINT "fk_meeting_guest_1" FOREIGN KEY ("booked_by_guest") REFERENCES "ruangrapat"."guest" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "ruangrapat"."meeting" ADD CONSTRAINT "fk_meeting_room_1" FOREIGN KEY ("room") REFERENCES "ruangrapat"."room" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "ruangrapat"."meeting" ADD CONSTRAINT "fk_meeting_user_1" FOREIGN KEY ("booked_by_user") REFERENCES "ruangrapat"."user" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "ruangrapat"."meeting" ADD CONSTRAINT "fk_meeting_user_2" FOREIGN KEY ("accepted_by") REFERENCES "ruangrapat"."user" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table room
-- ----------------------------
ALTER TABLE "ruangrapat"."room" ADD CONSTRAINT "fk_room_room_1" FOREIGN KEY ("parent_id") REFERENCES "ruangrapat"."room" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
