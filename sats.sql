/*
Navicat MySQL Data Transfer

Source Server         : asd
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : sats

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2017-02-03 17:33:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `account_table`
-- ----------------------------
DROP TABLE IF EXISTS `account_table`;
CREATE TABLE `account_table` (
  `emp_id` varchar(30) NOT NULL,
  `first_name` varchar(99) NOT NULL,
  `middle_name` varchar(99) DEFAULT NULL,
  `last_name` varchar(99) NOT NULL,
  `department` varchar(99) NOT NULL,
  `password` varchar(300) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of account_table
-- ----------------------------
INSERT INTO `account_table` VALUES ('CLN0009A', 'DONNA JOY', 'HERRERA', 'GODIO', 'BUILDING', 'CLN0009A', '1');
INSERT INTO `account_table` VALUES ('CLN0010A', 'LUISITO GREGORIO', 'SALAZAR', 'GUEVARA', 'BUILDING', 'CLN0010A', '1');
INSERT INTO `account_table` VALUES ('CLN0011F', 'MICHELLE', 'SEMENTILLA', 'GUINITARAN', 'BUILDING', 'CLN0011F', '1');
INSERT INTO `account_table` VALUES ('CLN0012F', 'JIMMY', 'BERNARDO', 'JOVERO', 'BUILDING', 'CLN0012F', '1');
INSERT INTO `account_table` VALUES ('CLN0013A', 'ARTEMIO', 'SERRATO', 'LUATON', 'BUILDING', 'CLN0013A', '1');
INSERT INTO `account_table` VALUES ('CLN0014F', 'EDITHA', 'AUSTRIA', 'MENDOZA', 'BUILDING', 'CLN0014F', '1');
INSERT INTO `account_table` VALUES ('CLN0015A', 'CRISDEL GERARD', 'GUEVARA', 'SALIMPADE', 'BUILDING', 'CLN0015A', '1');
INSERT INTO `account_table` VALUES ('CLN0016F', 'BERTHRAND KERWIN', 'TUAZON', 'SEVILLA', 'BUILDING', 'CLN0016F', '1');
INSERT INTO `account_table` VALUES ('CLN0017A', 'GINA', 'TUGNA', 'TERENCIO', 'BUILDING', 'CLN0017A', '1');
INSERT INTO `account_table` VALUES ('CLN0018P', 'ATHENA', 'MACAPAYAD', 'UNGRIANO', 'BUILDING', 'CLN0018P', '1');
INSERT INTO `account_table` VALUES ('CLN0019P', 'EMILY', 'VELASQUEZ', 'VILLAFLORES', 'BUILDING', 'CLN0019P', '1');
INSERT INTO `account_table` VALUES ('CLN0023F', 'HONORIO', 'ACLAN', 'MOJICA JR.', 'BUILDING', 'CLN0023F', '1');
INSERT INTO `account_table` VALUES ('CLN0024A', 'ROCHELLE', 'PERALTA', 'SANTIAGO', 'BUILDING', 'CLN0024A', '1');
INSERT INTO `account_table` VALUES ('CLN0025A', 'ARISTEO', 'AQUINO', 'VILLAFUERTE', 'BUILDING', 'CLN0025A', '1');
INSERT INTO `account_table` VALUES ('CLN0027A', 'ERWIN', 'PIKE', 'BA?EZ', 'BUILDING', 'CLN0027A', '1');
INSERT INTO `account_table` VALUES ('CLN0028A', 'ELVIRA', 'CANCINO', 'AMIDA', 'BUILDING', 'CLN0028A', '1');
INSERT INTO `account_table` VALUES ('CLN0030A', 'JANET', 'CA?ETE', 'POLICARPIO', 'BUILDING', 'CLN0030A', '1');
INSERT INTO `account_table` VALUES ('CLN0031A', 'EDWIN', 'SULIT', 'MATAYA', 'BUILDING', 'CLN0031A', '1');
INSERT INTO `account_table` VALUES ('CLN0032F', 'EMMALINE', 'VALENCIA', 'CUNANAN', 'BUILDING', 'CLN0032F', '1');
INSERT INTO `account_table` VALUES ('CLN0035A', 'RUFFA', 'MARI?O', 'SANTOS', 'BUILDING', 'CLN0035A', '1');
INSERT INTO `account_table` VALUES ('CLN0037F', 'BERNARD', 'AGUSTIN', 'MENDIOLA', 'BUILDING', 'CLN0037F', '1');
INSERT INTO `account_table` VALUES ('CLN0038F', 'RUVINA', 'TEOPE', 'MERCADO', 'BUILDING', 'CLN0038F', '1');
INSERT INTO `account_table` VALUES ('CLN0039A', 'ANNABELLE', 'ONANAD', 'VILLEGAS', 'BUILDING', 'CLN0039A', '1');
INSERT INTO `account_table` VALUES ('CLN0040A', 'JOEL', 'CORDERO', 'SAN DIEGO', 'BUILDING', 'CLN0040A', '1');
INSERT INTO `account_table` VALUES ('CLN0041A', 'ZENAIDA', 'TAPANG', 'CAGAYAN', 'BUILDING', 'CLN0041A', '1');
INSERT INTO `account_table` VALUES ('CLN0042A', 'MONICA', 'DELA ROSA', 'MALEDEO', 'BUILDING', 'CLN0042A', '1');
INSERT INTO `account_table` VALUES ('CLN0043F', 'JULIUS', 'PADERES', 'CLAOUR', 'BUILDING', 'CLN0043F', '1');
INSERT INTO `account_table` VALUES ('CLN0044F', 'WILSON', 'PEPITO', 'MENDOZA', 'BUILDING', 'CLN0044F', '1');
INSERT INTO `account_table` VALUES ('CLN0045F', 'BLENDA', 'BALLADA', 'BENSURTO', 'BUILDING', 'CLN0045F', '1');
INSERT INTO `account_table` VALUES ('CLN0046F', 'JAIME', 'ALCAZARIN', 'CANCHELA', 'BUILDING', 'CLN0046F', '1');
INSERT INTO `account_table` VALUES ('CLN0047F', 'JENNIFER', 'SALAS', 'DANILA', 'BUILDING', 'CLN0047F', '1');
INSERT INTO `account_table` VALUES ('CLN0048F', 'JENIEFER', 'CALDERON', 'ESPINO', 'BUILDING', 'CLN0048F', '1');
INSERT INTO `account_table` VALUES ('CLN0049P', 'PAULINE', 'CHOCO', 'GALINO', 'BUILDING', 'CLN0049P', '1');
INSERT INTO `account_table` VALUES ('CLN0050F', 'MARIO', 'CARREON', 'MORALES', 'BUILDING', 'CLN0050F', '1');
INSERT INTO `account_table` VALUES ('CLN0051F', 'DENNIS', 'SANCHEZ', 'NAVA', 'BUILDING', 'CLN0051F', '1');
INSERT INTO `account_table` VALUES ('CLN0052P', 'JEFFERSON', 'SORIANO', 'PABUSTAN', 'BUILDING', 'CLN0052P', '1');
INSERT INTO `account_table` VALUES ('CLN0053F', 'ANA AUREA', 'N/A', 'SANTIAGO', 'BUILDING', 'CLN0053F', '1');
INSERT INTO `account_table` VALUES ('CLN0054F', 'AUGUSTO', 'ANCHETA', 'SUNGA', 'BUILDING', 'CLN0054F', '1');
INSERT INTO `account_table` VALUES ('CLN0055F', 'FILIPINA', 'EVANGELISTA', 'MANUEL', 'BUILDING', 'CLN0055F', '1');
INSERT INTO `account_table` VALUES ('CLN0058P', 'NAPOLEON', 'START', 'OCAMPO', 'BUILDING', 'CLN0058P', '1');
INSERT INTO `account_table` VALUES ('CLN0059A', 'MICHAEL ALBERT', 'N/A', 'LIM', 'BUILDING', 'CLN0059A', '1');
INSERT INTO `account_table` VALUES ('CLN0060F', 'ARIANNE', 'SANTOS', 'HERRERA', 'BUILDING', 'CLN0060F', '1');
INSERT INTO `account_table` VALUES ('CLN0061A', 'JUAN PAULO', 'CALIXTO', 'NILAY', 'BUILDING', 'CLN0061A', '1');
INSERT INTO `account_table` VALUES ('CLN0062F', 'JOSEPH', 'MEDIANA', 'MANALASTAS', 'BUILDING', 'CLN0062F', '1');
INSERT INTO `account_table` VALUES ('CLN0064A', 'MARY GRACE', 'ZAMUDIO', 'CANDELARIO', 'BUILDING', 'CLN0064A', '1');
INSERT INTO `account_table` VALUES ('CLN0065F', 'REYNANTE', 'CASABA', 'SIDO', 'BUILDING', 'CLN0065F', '1');
INSERT INTO `account_table` VALUES ('CLN0066A', 'VALERIE ANN THERESE', 'MENDOZA', 'ALUNDAY', 'BUILDING', 'CLN0066A', '1');
INSERT INTO `account_table` VALUES ('CLN0067P', 'ARNOLD', 'DICHON', 'VIOLA', 'BUILDING', 'CLN0067P', '1');
INSERT INTO `account_table` VALUES ('CLN0070A', 'EMME LYN', 'UDAL', 'SORIA', 'BUILDING', 'CLN0070A', '1');
INSERT INTO `account_table` VALUES ('CLN0071F', 'ROBERT', 'ERPELO', 'ALMAZAN', 'BUILDING', 'CLN0071F', '1');
INSERT INTO `account_table` VALUES ('CLN0073F', 'BABY CYNTHIA', 'MALIGAYA', 'DIDAL', 'BUILDING', 'CLN0073F', '1');
INSERT INTO `account_table` VALUES ('CLN0075F', 'NESTER JAY', 'PADUA', 'MULDONG', 'BUILDING', 'CLN0075F', '1');
INSERT INTO `account_table` VALUES ('CLN0076F', 'JOCELYN', 'NU?EZ', 'QUIOZON', 'BUILDING', 'CLN0076F', '1');
INSERT INTO `account_table` VALUES ('CLN0080P', 'EMMANUEL', 'CABIA', 'AGUILAR', 'BUILDING', 'CLN0080P', '1');
INSERT INTO `account_table` VALUES ('CLN0082P', 'MA. ANGELA', 'ROA', 'TRINIDAD', 'BUILDING', 'CLN0082P', '1');
INSERT INTO `account_table` VALUES ('CLN0083A', 'RUBEN', 'GALVERO', 'SARZONA', 'BUILDING', 'CLN0083A', '1');
INSERT INTO `account_table` VALUES ('CLN0084F', 'FELIPE', 'FIGURACION', 'DAGDAG JR', 'BUILDING', 'CLN0084F', '1');
INSERT INTO `account_table` VALUES ('CLN0085F', 'RANDY JAMES', 'CUENCA', 'ADO-AN', 'BUILDING', 'CLN0085F', '1');
INSERT INTO `account_table` VALUES ('CLN0090F', 'REMIGIO', 'ENRIQUEZ', 'VITAN JR.', 'BUILDING', 'CLN0090F', '1');
INSERT INTO `account_table` VALUES ('CLN0093F', 'JAN KEVIN', 'MACASPAC', 'ALFARO', 'BUILDING', 'CLN0093F', '1');
INSERT INTO `account_table` VALUES ('CLN0094F', 'EDNA', 'PADUA', 'AQUINO', 'BUILDING', 'CLN0094F', '1');
INSERT INTO `account_table` VALUES ('CLN0095F', 'JOHN DAVE', 'REGACHO', 'BAUTISTA', 'BUILDING', 'CLN0095F', '1');
INSERT INTO `account_table` VALUES ('CLN0096F', 'TIFFANY MICHELLE', 'SY', 'CHUA', 'BUILDING', 'CLN0096F', '1');
INSERT INTO `account_table` VALUES ('CLN0097F', 'EDITA', 'ENTE', 'DE GUZMAN', 'BUILDING', 'CLN0097F', '1');
INSERT INTO `account_table` VALUES ('CLN0099F', 'FLORINDA', 'ONANDIA', 'ISAAC', 'BUILDING', 'CLN0099F', '1');
INSERT INTO `account_table` VALUES ('CLN0100F', 'ROMMEL', 'TOLENTINO', 'LAGASCA', 'BUILDING', 'CLN0100F', '1');
INSERT INTO `account_table` VALUES ('CLN0102F', 'DANIEL KARLO', 'GARCIA', 'LUCAS', 'BUILDING', 'CLN0102F', '1');
INSERT INTO `account_table` VALUES ('CLN0103F', 'RICHARD', 'ROCE', 'MAESTRE', 'BUILDING', 'CLN0103F', '1');
INSERT INTO `account_table` VALUES ('CLN0104F', 'ROBINSON', 'LASIN', 'MAPA', 'BUILDING', 'CLN0104F', '1');
INSERT INTO `account_table` VALUES ('CLN0105F', 'RIA', 'N/A', 'OROLFO', 'BUILDING', 'CLN0105F', '1');
INSERT INTO `account_table` VALUES ('CLN0106F', 'JESSICA CRYSTIN', 'LU', 'PERALTA', 'BUILDING', 'CLN0106F', '1');
INSERT INTO `account_table` VALUES ('CLN0110P', 'RACHELLE', 'DIVINASFLORES', 'BASILIO', 'BUILDING', 'CLN0110P', '1');
INSERT INTO `account_table` VALUES ('CLN0120F', 'JULLA', 'CATALAN', 'OSABEL', 'BUILDING', 'CLN0120F', '1');
INSERT INTO `account_table` VALUES ('CLN0122F', 'KAREN ANNE', 'TIBAYAN', 'SALAPONG', 'BUILDING', 'CLN0122F', '1');
INSERT INTO `account_table` VALUES ('CLN0123F', 'MARCELO', 'ESPINO', 'VARONA', 'BUILDING', 'CLN0123F', '1');
INSERT INTO `account_table` VALUES ('CLN0127P', 'CARYL', 'RASCO', 'BULAY', 'BUILDING', 'CLN0127P', '1');
INSERT INTO `account_table` VALUES ('CLN0136P', 'ALVIN RAY', 'DRIZA', 'ESTIVA', 'BUILDING', 'CLN0136P', '1');
INSERT INTO `account_table` VALUES ('CLN0138F', 'JOSIELYN', 'CORCINO', 'BIRON', 'BUILDING', 'CLN0138F', '1');
INSERT INTO `account_table` VALUES ('CLN0141F', 'MELODY', 'JORNADAL', 'DACANAY', 'BUILDING', 'CLN0141F', '1');
INSERT INTO `account_table` VALUES ('CLN0142F', 'GIRLIE', 'BUGTONG', 'LORENO', 'BUILDING', 'CLN0142F', '1');
INSERT INTO `account_table` VALUES ('CLN0143F', 'MERLE', 'PALAROAN', 'LASCANO', 'BUILDING', 'CLN0143F', '1');
INSERT INTO `account_table` VALUES ('CLN0147A', 'VIRMIE', 'CENTENO', 'ARENAS', 'BUILDING', 'CLN0147A', '1');
INSERT INTO `account_table` VALUES ('CLN0149A', 'SHARMAINE', 'TUMAQUE', 'PEREDA', 'BUILDING', 'CLN0149A', '1');
INSERT INTO `account_table` VALUES ('CLN0152F', 'MENCHU', 'EVANGELISTA', 'DELA CRUZ', 'BUILDING', 'CLN0152F', '1');
INSERT INTO `account_table` VALUES ('CLN0158F', 'JHON ANGELO', 'MERGANO', 'SAN ANDRES', 'BUILDING', 'CLN0158F', '1');
INSERT INTO `account_table` VALUES ('CLN0162A', 'MARIA ELENA', 'ROMERO', 'OBALDO', 'BUILDING', 'CLN0162A', '1');
INSERT INTO `account_table` VALUES ('CLN0163A', 'CATHERINE', 'IBA?EZ', 'CANO', 'BUILDING', 'CLN0163A', '1');
INSERT INTO `account_table` VALUES ('CLN0165A', 'CARLA MARIE', 'DUBLIN', 'ROSARIO', 'BUILDING', 'CLN0165A', '1');
INSERT INTO `account_table` VALUES ('CLN0166F', 'GRETHELYN', 'MALSI', 'BARREDO', 'BUILDING', 'CLN0166F', '1');
INSERT INTO `account_table` VALUES ('CLN0168F', 'ALFON JOHN', 'N/A', 'BERMUDO', 'BUILDING', 'CLN0168F', '1');
INSERT INTO `account_table` VALUES ('CLN0172F', 'ARMANDO', 'GESOLGANI', 'ENALAN JR.', 'BUILDING', 'CLN0172F', '1');
INSERT INTO `account_table` VALUES ('CLN0173F', 'JUNE ROSE', 'AGONOY', 'ESTRADA', 'BUILDING', 'CLN0173F', '1');
INSERT INTO `account_table` VALUES ('CLN0174F', 'NADINE', 'TECSON', 'MENDOZA', 'BUILDING', 'CLN0174F', '1');
INSERT INTO `account_table` VALUES ('CLN0176F', 'ALVIN', 'SALAZAR', 'ROSALES', 'BUILDING', 'CLN0176F', '1');
INSERT INTO `account_table` VALUES ('CLN0177F', 'JENNIFER', 'TRIA', 'VINLUAN', 'BUILDING', 'CLN0177F', '1');
INSERT INTO `account_table` VALUES ('CLN0178P', 'RONELSON', 'PADAGAS', 'BULAO', 'BUILDING', 'CLN0178P', '1');
INSERT INTO `account_table` VALUES ('CLN0179P', 'MARK LESTER', 'CRISOSTOMO', 'CUAYZON', 'BUILDING', 'CLN0179P', '1');
INSERT INTO `account_table` VALUES ('CLN0183P', 'ERIC', 'LASIN', 'MALABANAN', 'BUILDING', 'CLN0183P', '1');
INSERT INTO `account_table` VALUES ('CLN0184P', 'MARIE ANTONETTE', 'CABRERA', 'MARCELO', 'BUILDING', 'CLN0184P', '1');
INSERT INTO `account_table` VALUES ('CLN0185P', 'RUEL', 'HALDOS', 'PALCUTO', 'BUILDING', 'CLN0185P', '1');
INSERT INTO `account_table` VALUES ('CLN0186P', 'ALYANA', 'TORRES', 'SALIDO', 'BUILDING', 'CLN0186P', '1');
INSERT INTO `account_table` VALUES ('CLN0189F', 'ISIDRO', 'NONES', 'ERISPE', 'BUILDING', 'CLN0189F', '1');
INSERT INTO `account_table` VALUES ('CLN0190F', 'MARVIN', 'FLORES', 'MEDINA', 'BUILDING', 'CLN0190F', '1');
INSERT INTO `account_table` VALUES ('CLN0192F', 'MAR ELI', 'CONSTANTINO', 'SAGSAGAT', 'BUILDING', 'CLN0192F', '1');
INSERT INTO `account_table` VALUES ('CLN0193F', 'GLENN CARLO', 'GALANG', 'TIMAJO', 'BUILDING', 'CLN0193F', '1');
INSERT INTO `account_table` VALUES ('CLN0195P', 'REYNALDO', 'TORRES', 'SALIDO JR.', 'BUILDING', 'CLN0195P', '1');
INSERT INTO `account_table` VALUES ('CLN0197F', 'REYZIEL', 'SAMONTE', 'ALZATE', 'BUILDING', 'CLN0197F', '1');
INSERT INTO `account_table` VALUES ('CLN0198F', 'MICHAEL ANGELO', 'PARANADA', 'ARABE', 'BUILDING', 'CLN0198F', '1');
INSERT INTO `account_table` VALUES ('CLN0199F', 'JAY JEROME', 'CAPARAS', 'BUCE', 'BUILDING', 'CLN0199F', '1');
INSERT INTO `account_table` VALUES ('CLN0200F', 'EUNICE', 'DARASIN', 'TAYABAS', 'BUILDING', 'CLN0200F', '1');
INSERT INTO `account_table` VALUES ('CLN0201P', 'AARON BREN', 'EVANGELISTA', 'JULATON', 'BUILDING', 'CLN0201P', '1');
INSERT INTO `account_table` VALUES ('CLN0204F', 'MELISSA', 'MELENDRES', 'CAABAY', 'BUILDING', 'CLN0204F', '1');
INSERT INTO `account_table` VALUES ('CLN0205F', 'GELITA', 'GERIENTE', 'COLON', 'BUILDING', 'CLN0205F', '1');
INSERT INTO `account_table` VALUES ('CLN0207F', 'MA. LORENA', 'TODOC', 'CALAUOD', 'BUILDING', 'CLN0207F', '1');
INSERT INTO `account_table` VALUES ('CLN0210F', 'EDWARD', 'BONIFACIO', 'LACAP', 'BUILDING', 'CLN0210F', '1');
INSERT INTO `account_table` VALUES ('CLN0218A', 'WITTY MAE', 'REAS', 'VITASA', 'BUILDING', 'CLN0218A', '1');
INSERT INTO `account_table` VALUES ('CLN0219F', 'MA. CRISTINA', 'MAGARZO', 'CAPELLAN', 'BUILDING', 'CLN0219F', '1');
INSERT INTO `account_table` VALUES ('CLN0221P', 'CLARISA', 'CRISOSTOMO', 'AVILA', 'BUILDING', 'CLN0221P', '1');
INSERT INTO `account_table` VALUES ('CLN0222F', 'MARC ARDIE', 'VILLAGRACIA', 'ARDIENTE', 'BUILDING', 'CLN0222F', '1');
INSERT INTO `account_table` VALUES ('CLN0224F', 'SHIENNA MARIE', 'BALTAZAR', 'SALVADOR', 'BUILDING', 'CLN0224F', '1');
INSERT INTO `account_table` VALUES ('CLN0226F', 'CHARLENE ANTOINETTE', 'MAMARIL', 'JAVIER', 'BUILDING', 'CLN0226F', '1');
INSERT INTO `account_table` VALUES ('CLN0227P', 'TOSHIO AKIRA', 'N/A', 'CAPINTOG', 'BUILDING', 'CLN0227P', '1');
INSERT INTO `account_table` VALUES ('CLN0228F', 'MARY GRACE', 'VILLAFLOR', 'TABANGCURA', 'BUILDING', 'CLN0228F', '1');
INSERT INTO `account_table` VALUES ('CLN0229A', 'APPLE', 'FIDELES', 'RASAY', 'BUILDING', 'CLN0229A', '1');
INSERT INTO `account_table` VALUES ('CLN0230A', 'JONALYN', 'GONZALES', 'VILA', 'BUILDING', 'CLN0230A', '1');
INSERT INTO `account_table` VALUES ('CLN0231F', 'EDZEL', 'DEVELOS', 'BATUIGAS', 'BUILDING', 'CLN0231F', '1');
INSERT INTO `account_table` VALUES ('CLN0232F', 'JENIFFER', 'ROSARIO', 'BRILLANTES', 'BUILDING', 'CLN0232F', '1');
INSERT INTO `account_table` VALUES ('CLN0233F', 'GLARE ANNE', 'ENRIQUEZ', 'BUSANO', 'BUILDING', 'CLN0233F', '1');
INSERT INTO `account_table` VALUES ('CLN0234F', 'MARK GUILER', 'N/A', 'CUEVAS', 'BUILDING', 'CLN0234F', '1');
INSERT INTO `account_table` VALUES ('CLN0235F', 'BRYAN', 'PASCUAL', 'DE GUZMAN', 'BUILDING', 'CLN0235F', '1');
INSERT INTO `account_table` VALUES ('CLN0236F', 'PHILIP ELEAZAR', 'DIOKNO', 'FAUSTINO', 'BUILDING', 'CLN0236F', '1');
INSERT INTO `account_table` VALUES ('CLN0237F', 'LOIDA', 'BAUTISTA', 'FURISCAL', 'BUILDING', 'CLN0237F', '1');
INSERT INTO `account_table` VALUES ('CLN0238F', 'JIREH', 'GACAYAN', 'GABASA', 'BUILDING', 'CLN0238F', '1');
INSERT INTO `account_table` VALUES ('CLN0239F', 'LAURENCE GERON', 'PAR', 'GONZALES', 'BUILDING', 'CLN0239F', '1');
INSERT INTO `account_table` VALUES ('CLN0240F', 'DANIEL', 'SOLIS', 'JAUCIAN', 'BUILDING', 'CLN0240F', '1');
INSERT INTO `account_table` VALUES ('CLN0241F', 'JAYMA ROSE', 'TANTAY', 'LOBATON', 'BUILDING', 'CLN0241F', '1');
INSERT INTO `account_table` VALUES ('CLN0242F', 'MARIA PAZ', 'DEVANADERA', 'LOPEZ', 'BUILDING', 'CLN0242F', '1');
INSERT INTO `account_table` VALUES ('CLN0243F', 'MARIA FE ROWENA', 'YUSON', 'MAGCALE', 'BUILDING', 'CLN0243F', '1');
INSERT INTO `account_table` VALUES ('CLN0244F', 'NEIL PATRICK', 'MARCOS', 'MARTIN', 'BUILDING', 'CLN0244F', '1');
INSERT INTO `account_table` VALUES ('CLN0245F', 'RIZCHEL', 'MEJORADO', 'MASONG', 'BUILDING', 'CLN0245F', '1');
INSERT INTO `account_table` VALUES ('CLN0246F', 'JOHN PAUL', 'CATANGHAL', 'MORALES', 'BUILDING', 'CLN0246F', '1');
INSERT INTO `account_table` VALUES ('CLN0247F', 'MARA CAMILLE', 'BALBERO', 'NA?EZ', 'BUILDING', 'CLN0247F', '1');
INSERT INTO `account_table` VALUES ('CLN0248F', 'JENNIFER', 'DULALIA', 'ORTIZ', 'BUILDING', 'CLN0248F', '1');
INSERT INTO `account_table` VALUES ('CLN0249F', 'RAGINE FHEL', 'ABAYON', 'PANALIGAN', 'BUILDING', 'CLN0249F', '1');
INSERT INTO `account_table` VALUES ('CLN0250F', 'JUDITH ALLYSON', 'ABU', 'RAEL', 'BUILDING', 'CLN0250F', '1');
INSERT INTO `account_table` VALUES ('CLN0251F', 'ANNA CHERRY', 'BELLEZA', 'RECLUTA', 'BUILDING', 'CLN0251F', '1');
INSERT INTO `account_table` VALUES ('CLN0252F', 'NICOLE', 'BEUNO', 'RIBANO', 'BUILDING', 'CLN0252F', '1');
INSERT INTO `account_table` VALUES ('CLN0253F', 'JOHN KENNETH', 'OMBAJEN', 'SANTOS', 'BUILDING', 'CLN0253F', '1');
INSERT INTO `account_table` VALUES ('CLN0254F', 'RACHELLE ANN', 'SOCAO', 'SANTOS', 'BUILDING', 'CLN0254F', '1');
INSERT INTO `account_table` VALUES ('CLN0255F', 'JESSIE', 'DELFIN', 'TORRES', 'BUILDING', 'CLN0255F', '1');
INSERT INTO `account_table` VALUES ('CLN0256F', 'JOVELYN ANN', 'URRETA', 'VILLAMATER', 'BUILDING', 'CLN0256F', '1');
INSERT INTO `account_table` VALUES ('CLN0257F', 'RICHELLE', 'TOLEDANES', 'BEAQUIN', 'BUILDING', 'CLN0257F', '1');
INSERT INTO `account_table` VALUES ('CLN0258F', 'ANGELO', 'SILVA', 'BONGA', 'BUILDING', 'CLN0258F', '1');
INSERT INTO `account_table` VALUES ('CLN0259F', 'KAMIL JADE', 'AQUINO', 'CORPUZ', 'BUILDING', 'CLN0259F', '1');
INSERT INTO `account_table` VALUES ('CLN0260F', 'ROCHELLE ANN', 'VILLAPA?A', 'RONDOLO', 'BUILDING', 'CLN0260F', '1');
INSERT INTO `account_table` VALUES ('CLN0261F', 'JONASELLE', 'ONG', 'CRISTOBAL', 'BUILDING', 'CLN0261F', '1');
INSERT INTO `account_table` VALUES ('CLN0262F', 'JESRAH', 'DELOS REYES', 'GALICHA', 'BUILDING', 'CLN0262F', '1');
INSERT INTO `account_table` VALUES ('CLN0263F', 'JHESA', 'DAVID', 'BAISA', 'BUILDING', 'CLN0263F', '1');
INSERT INTO `account_table` VALUES ('CLN0264F', 'MARY JANE', 'GIRON', 'OCAMPO', 'BUILDING', 'CLN0264F', '1');
INSERT INTO `account_table` VALUES ('CLN0265F', 'FLORIZA', 'NOLASCO', 'GONZALES', 'BUILDING', 'CLN0265F', '1');
INSERT INTO `account_table` VALUES ('CLN0266F', 'EVANGELINE', 'ALMIRON', 'MIRANDA', 'BUILDING', 'CLN0266F', '1');
INSERT INTO `account_table` VALUES ('CLN0267F', 'VIVOE', 'ROBERTO', 'ABARIENTOS', 'BUILDING', 'CLN0267F', '1');
INSERT INTO `account_table` VALUES ('CLN0268F', 'MORRIS MARCO', 'SANTOS', 'LIM', 'BUILDING', 'CLN0268F', '1');
INSERT INTO `account_table` VALUES ('CLN0269F', 'MARK JOHNSON', 'FADERES', 'TACLAHAN', 'BUILDING', 'CLN0269F', '1');
INSERT INTO `account_table` VALUES ('CLN0270F', 'ANDREA', 'TABING', 'TAYCO', 'BUILDING', 'CLN0270F', '1');
INSERT INTO `account_table` VALUES ('CLN0271P', 'CECILIA', 'LINGATONG', 'BACARES', 'BUILDING', 'CLN0271P', '1');
INSERT INTO `account_table` VALUES ('CLN0272P', 'JOSEPH REYNALD', 'AUSTRIA', 'RONQUILLO', 'BUILDING', 'CLN0272P', '1');
INSERT INTO `account_table` VALUES ('CLN0273F', 'MARIA LUZ', 'BUNAG', 'SABENIANO', 'BUILDING', 'CLN0273F', '1');
INSERT INTO `account_table` VALUES ('CLN0274P', 'JOEL', 'GONZALES', 'VEDASTO', 'BUILDING', 'CLN0274P', '1');
INSERT INTO `account_table` VALUES ('CLN0275F', 'RV CYRILLE', 'DIZON', 'MERTO', 'BUILDING', 'CLN0275F', '1');
INSERT INTO `account_table` VALUES ('CLN0276P', 'JOANNA MARIE', 'CAROLINO', 'ROQUE', 'BUILDING', 'CLN0276P', '1');
INSERT INTO `account_table` VALUES ('CLN0277P', 'AURORA', 'LACSON', 'NAVARRO', 'BUILDING', 'CLN0277P', '1');
INSERT INTO `account_table` VALUES ('CLN0278F', 'GABRIEL', 'LUCERNAS', 'PASCUAL', 'BUILDING', 'CLN0278F', '1');
INSERT INTO `account_table` VALUES ('CLN0279F', 'GRACE', 'CABRAL', 'RONQUILLO', 'BUILDING', 'CLN0279F', '1');
INSERT INTO `account_table` VALUES ('CLN0281A', 'EUSEBIO', 'GUTTIEREZ', 'MURILLO', 'BUILDING', 'CLN0281A', '1');
INSERT INTO `account_table` VALUES ('CLN0291A', 'EDWARD DAVES', '', 'MIRAVETE', 'BUILDING', 'CLN0291A', '1');

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `emp_id` varchar(30) NOT NULL,
  `first_name` varchar(99) NOT NULL,
  `middle_name` varchar(99) NOT NULL,
  `last_name` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('admin', 'Marife', 'Capalad', 'Ibarra', 'admin');
INSERT INTO `admin` VALUES ('head', 'Marivic', 'Mawanay', 'Baello', 'head');

-- ----------------------------
-- Table structure for `audit_trail_condition`
-- ----------------------------
DROP TABLE IF EXISTS `audit_trail_condition`;
CREATE TABLE `audit_trail_condition` (
  `action` varchar(255) NOT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of audit_trail_condition
-- ----------------------------
INSERT INTO `audit_trail_condition` VALUES ('updated condition in', '2017-01-30 04:29:59');
INSERT INTO `audit_trail_condition` VALUES ('updated condition in', '2017-01-30 04:30:00');
INSERT INTO `audit_trail_condition` VALUES ('updated condition in', '2017-01-30 04:30:02');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of Array from Good to Fair', '2017-01-30 04:35:06');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-040 from Good to Fair', '2017-01-30 04:35:34');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the location of CLNOSE342014-006 from 2ND FLOOR- 208 to 2ND FLOOR- 202', null);
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-006 from Defective to Good', '2017-01-30 04:59:36');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-021 from Good to Defective', '2017-01-30 05:00:15');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-013 from Fair to Scrap', '2017-01-30 05:00:59');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-006 from Good to Fair', '2017-01-30 05:03:50');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-040 from Fair to Good', '2017-01-30 05:04:14');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-040 from Good to Fair', '2017-01-30 05:04:30');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-040 from Fair to Scrap', '2017-01-30 06:42:52');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-021 from Defective to Good', '2017-01-30 06:42:57');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-006 from Fair to Defective', '2017-01-30 06:43:01');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-006 from Defective to Good', '2017-01-30 06:43:03');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-013 from Scrap to Good', '2017-01-30 06:43:04');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-040 from Scrap to Good', '2017-01-30 06:43:06');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-013 from Good to Fair', '2017-01-30 06:52:23');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-013 from Fair to Poor', '2017-01-30 06:52:28');
INSERT INTO `audit_trail_condition` VALUES ('CLN0025A updated the condition of CLNOSE342014-013 from Poor to Good', '2017-01-30 06:52:30');

-- ----------------------------
-- Table structure for `audit_trail_location`
-- ----------------------------
DROP TABLE IF EXISTS `audit_trail_location`;
CREATE TABLE `audit_trail_location` (
  `action` varchar(255) NOT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of audit_trail_location
-- ----------------------------
INSERT INTO `audit_trail_location` VALUES ('updated condition in', '2017-01-30 04:29:59');
INSERT INTO `audit_trail_location` VALUES ('updated condition in', '2017-01-30 04:30:00');
INSERT INTO `audit_trail_location` VALUES ('updated condition in', '2017-01-30 04:30:02');
INSERT INTO `audit_trail_location` VALUES ('CLN0025A updated the condition of Array from Good to Fair', '2017-01-30 04:35:06');
INSERT INTO `audit_trail_location` VALUES ('CLN0025A updated the condition of CLNOSE342014-040 from Good to Fair', '2017-01-30 04:35:34');
INSERT INTO `audit_trail_location` VALUES ('CLN0025A updated the location of CLNOSE342014-006 from 2ND FLOOR- 208 to 2ND FLOOR- 201', null);
INSERT INTO `audit_trail_location` VALUES ('CLN0025A updated the location of CLNOSE342014-021 from 2ND FLOOR- 209 to 2ND FLOOR- 202', '2017-01-30 04:48:23');

-- ----------------------------
-- Table structure for `borrow_request`
-- ----------------------------
DROP TABLE IF EXISTS `borrow_request`;
CREATE TABLE `borrow_request` (
  `request_code` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `condition_id` int(2) NOT NULL,
  `old_loc_id` int(11) NOT NULL,
  `new_loc_id` int(11) NOT NULL,
  `transfer_to` varchar(30) NOT NULL,
  `released_from` varchar(30) NOT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `date_request` datetime NOT NULL,
  `date_borrow` datetime NOT NULL,
  `emp_approval` int(1) NOT NULL,
  `date_approved` datetime NOT NULL,
  PRIMARY KEY (`request_code`,`id`,`condition_id`,`old_loc_id`,`released_from`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of borrow_request
-- ----------------------------
INSERT INTO `borrow_request` VALUES ('1', '5', '1', '1', '11', '12', 'CLN0291A', 'CLN0025A', null, '2017-01-25 09:29:25', '0000-00-00 00:00:00', '1', '2017-01-26 13:40:49');

-- ----------------------------
-- Table structure for `borrow_request_history`
-- ----------------------------
DROP TABLE IF EXISTS `borrow_request_history`;
CREATE TABLE `borrow_request_history` (
  `ctrl_no` varchar(30) NOT NULL,
  `sy` varchar(4) NOT NULL,
  `no` int(11) NOT NULL,
  `request_code` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `condition_id` int(11) NOT NULL,
  `old_loc_id` int(11) NOT NULL,
  `new_loc_Id` int(11) NOT NULL,
  `borrowed_to` varchar(30) NOT NULL,
  `released_from` varchar(30) NOT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `date_approved` datetime NOT NULL,
  `date_returned` datetime NOT NULL,
  `date_actual_returned` datetime NOT NULL,
  PRIMARY KEY (`ctrl_no`,`id`,`condition_id`,`old_loc_id`,`released_from`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of borrow_request_history
-- ----------------------------
INSERT INTO `borrow_request_history` VALUES ('CLN-1617-00001O', '1617', '1', '2', '12', '1', '1', '17', '13', 'CLN0291A', 'CLN0025A', null, '2017-01-26 14:46:40', '2017-09-04 01:17:00', '2017-01-26 16:46:32');
INSERT INTO `borrow_request_history` VALUES ('CLN-1617-00002O', '1617', '2', '2', '12', '1', '1', '17', '13', 'CLN0291A', 'CLN0025A', null, '2017-01-26 14:46:40', '2017-09-04 01:17:00', '2017-01-27 10:42:34');
INSERT INTO `borrow_request_history` VALUES ('CLN-1617-00003O', '1617', '3', '2', '6', '1', '1', '12', '16', 'CLN0025A', 'CLN0291A', null, '2017-01-27 16:33:52', '2017-01-01 02:00:00', '2017-01-27 16:35:51');
INSERT INTO `borrow_request_history` VALUES ('CLN-1617-00004O', '1617', '4', '2', '6', '1', '1', '12', '13', 'CLN0025A', 'CLN0291A', null, '2017-01-30 15:24:03', '2017-01-31 02:00:00', '2017-01-30 15:32:28');

-- ----------------------------
-- Table structure for `condition_info`
-- ----------------------------
DROP TABLE IF EXISTS `condition_info`;
CREATE TABLE `condition_info` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `condition_info` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of condition_info
-- ----------------------------
INSERT INTO `condition_info` VALUES ('1', 'Good');
INSERT INTO `condition_info` VALUES ('2', 'Poor');
INSERT INTO `condition_info` VALUES ('3', 'Fair');
INSERT INTO `condition_info` VALUES ('4', 'Defective');
INSERT INTO `condition_info` VALUES ('5', 'Scrap');

-- ----------------------------
-- Table structure for `ctrl_sy`
-- ----------------------------
DROP TABLE IF EXISTS `ctrl_sy`;
CREATE TABLE `ctrl_sy` (
  `sy` varchar(4) NOT NULL,
  PRIMARY KEY (`sy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ctrl_sy
-- ----------------------------
INSERT INTO `ctrl_sy` VALUES ('1617');

-- ----------------------------
-- Table structure for `location`
-- ----------------------------
DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `location` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of location
-- ----------------------------
INSERT INTO `location` VALUES ('5', 'MEZZANINE - FACULTY');
INSERT INTO `location` VALUES ('6', '3RD FLOOR - 306');
INSERT INTO `location` VALUES ('7', '4TH FLOOR - 407');
INSERT INTO `location` VALUES ('8', '3RD FLOOR - 302');
INSERT INTO `location` VALUES ('9', '2ND FLOOR - 211');
INSERT INTO `location` VALUES ('10', '3RD FLOOR - 311');
INSERT INTO `location` VALUES ('11', '3RD FLOOR - 303');
INSERT INTO `location` VALUES ('12', '2ND FLOOR - 208');
INSERT INTO `location` VALUES ('13', '2ND FLOOR - 209');
INSERT INTO `location` VALUES ('14', '3RD FLOOR - 301');
INSERT INTO `location` VALUES ('15', '2ND FLOOR - 210');
INSERT INTO `location` VALUES ('16', '3RD FLOOR - 310');
INSERT INTO `location` VALUES ('17', '3RD FLOOR - 307');
INSERT INTO `location` VALUES ('18', '2ND FLOOR - 212');
INSERT INTO `location` VALUES ('19', '2ND FLOOR - 202');
INSERT INTO `location` VALUES ('20', '4TH FLOOR - 401');
INSERT INTO `location` VALUES ('21', '6TH FLOOR - 610');
INSERT INTO `location` VALUES ('22', '2ND FLOOR - 204');
INSERT INTO `location` VALUES ('23', '2ND FLOOR - 206');
INSERT INTO `location` VALUES ('24', '2ND FLOOR - 203');
INSERT INTO `location` VALUES ('25', '7TH FLOOR - 705');
INSERT INTO `location` VALUES ('26', '7TH FLOOR - 704');
INSERT INTO `location` VALUES ('27', '8TH FLOOR - 804');
INSERT INTO `location` VALUES ('28', '3RD FLOOR - 305');
INSERT INTO `location` VALUES ('29', '6TH FLOOR - 604');
INSERT INTO `location` VALUES ('30', 'GROUND FLOOR - GUIDANCE');
INSERT INTO `location` VALUES ('31', '6TH FLOOR - 606');
INSERT INTO `location` VALUES ('32', '6TH FLOOR - 603');
INSERT INTO `location` VALUES ('33', '8TH FLOOR - LIBRARY');
INSERT INTO `location` VALUES ('34', 'GROUND FLOOR - REGISTRAR');
INSERT INTO `location` VALUES ('35', 'GROUND FLOOR - CASHIER');
INSERT INTO `location` VALUES ('36', '4TH FLOOR - 406');
INSERT INTO `location` VALUES ('37', '7TH FLOOR - KITCHEN STORAGE 1');
INSERT INTO `location` VALUES ('38', '7TH FLOOR -705');
INSERT INTO `location` VALUES ('39', '4TH FLOOR - 409');
INSERT INTO `location` VALUES ('40', '4TH FLOOR - 408');
INSERT INTO `location` VALUES ('41', 'GROUND FLOOR - 101');
INSERT INTO `location` VALUES ('42', '8TH FLOOR - 803');
INSERT INTO `location` VALUES ('43', 'GROUND FLOOR - ACCOUNTING');
INSERT INTO `location` VALUES ('44', '6TH FLOOR - 608');
INSERT INTO `location` VALUES ('45', '8TH FLOOR - 801');
INSERT INTO `location` VALUES ('46', '4TH FLOOR - 409B');
INSERT INTO `location` VALUES ('47', '7TH FLOOR - 703');
INSERT INTO `location` VALUES ('48', '4TH FLOOR -  410');
INSERT INTO `location` VALUES ('49', 'GROUND FLOOR - PROWARE');
INSERT INTO `location` VALUES ('50', '2ND FLOOR - 201');
INSERT INTO `location` VALUES ('51', '7TH FLOOR - BAR ROOM');
INSERT INTO `location` VALUES ('52', '3RD FLOOR - 309');
INSERT INTO `location` VALUES ('53', '3RD FLOOR - 308');
INSERT INTO `location` VALUES ('54', 'MEZZANINE - DSA OFFICE');
INSERT INTO `location` VALUES ('55', '6TH FLOOR - 602');
INSERT INTO `location` VALUES ('56', '6TH FLOOR - 609');
INSERT INTO `location` VALUES ('57', 'GROUND FLOOR - HR');
INSERT INTO `location` VALUES ('58', '6TH FLOOR - 607');
INSERT INTO `location` VALUES ('59', '6TH FLOOR - 601');
INSERT INTO `location` VALUES ('60', '6TH FLOOR - 605');
INSERT INTO `location` VALUES ('61', 'STOLEN');
INSERT INTO `location` VALUES ('62', 'GROUND FLOOR - ADMISSION');
INSERT INTO `location` VALUES ('63', 'GROUND FLOOR - IDF');
INSERT INTO `location` VALUES ('64', '2ND FLOOR - STORAGE');
INSERT INTO `location` VALUES ('65', '4TH FLOOR - STORAGE');
INSERT INTO `location` VALUES ('66', 'MEZZANINE - SA/DSA ROOM');
INSERT INTO `location` VALUES ('67', 'GROUND FLOOR - BLDG ADMIN');
INSERT INTO `location` VALUES ('68', '8TH FLOOR -LIBRARY');
INSERT INTO `location` VALUES ('69', ' 4TH FLOOR - 405 ');
INSERT INTO `location` VALUES ('70', 'GROUND FLOOR- PROWARE');
INSERT INTO `location` VALUES ('71', '6TH FLOOR STORAGE');
INSERT INTO `location` VALUES ('72', '4TH FLOOR - 409A');
INSERT INTO `location` VALUES ('73', '8TH FLOOR - 805');
INSERT INTO `location` VALUES ('74', '7TH FLOOR - PHYSIC-LAB');
INSERT INTO `location` VALUES ('75', '2ND FLOOR - 205');
INSERT INTO `location` VALUES ('76', 'MEZZANINE - ACADEMIC HEAD\'S OFFICE');
INSERT INTO `location` VALUES ('77', '008-CE11-2012-001??');
INSERT INTO `location` VALUES ('78', '4TH FLOOR - 410 STORAGE');
INSERT INTO `location` VALUES ('79', 'GROUND FLOOR - CLINIC');
INSERT INTO `location` VALUES ('80', '7TH FLOOR - 702');
INSERT INTO `location` VALUES ('81', 'PERIMETER');
INSERT INTO `location` VALUES ('82', '7TH FLOOR - KITCHEN');
INSERT INTO `location` VALUES ('83', 'MEZZANINE - ADMISSION STORAGE');
INSERT INTO `location` VALUES ('84', '5TH FLOOR - 502 STORAGE');
INSERT INTO `location` VALUES ('85', '5TH FLOOR - CANTEEN');
INSERT INTO `location` VALUES ('86', '7TH FLOOR - SUITE ROOM');
INSERT INTO `location` VALUES ('87', 'MEZZANINE - CONFERENCE ROOM');
INSERT INTO `location` VALUES ('88', 'GROUND FLOOR - ACCOUNTING STORAGE');
INSERT INTO `location` VALUES ('89', 'GROUND FLOOR - MAINTENANCE ROOM');
INSERT INTO `location` VALUES ('90', 'CANTEEN');
INSERT INTO `location` VALUES ('91', 'GROUND FLOOR - GUARD');
INSERT INTO `location` VALUES ('92', 'MEZZANINE - RECORD\'S ROOM');
INSERT INTO `location` VALUES ('93', '5TH FLOOR - AUXILLIARY ROOM');
INSERT INTO `location` VALUES ('94', 'GENSET');
INSERT INTO `location` VALUES ('95', 'GROUND FLOOR - ADMISSION OFFICE');
INSERT INTO `location` VALUES ('96', 'MEZZANINEI - ACAD\'S HEAD OFFICE');
INSERT INTO `location` VALUES ('97', 'GROUND FLOOR - CONSULTATION ROOM');
INSERT INTO `location` VALUES ('98', 'GROUND FLOOR - ADMIN');
INSERT INTO `location` VALUES ('99', 'MEZZANININE - FACULTY STORAGE');
INSERT INTO `location` VALUES ('100', 'MEZZANINE - FACULTY STORAGE');
INSERT INTO `location` VALUES ('101', 'GENERATOR ROOM');
INSERT INTO `location` VALUES ('102', 'CANTEEN - KITCHEN');
INSERT INTO `location` VALUES ('103', 'CANTEEN - GROUND FLOOR');
INSERT INTO `location` VALUES ('104', 'CANTEEN - BROWER');
INSERT INTO `location` VALUES ('105', '5TH FLOOR');
INSERT INTO `location` VALUES ('106', 'CANTEEN - 2ND FLOOR');
INSERT INTO `location` VALUES ('107', 'GROUND FLOOR - GENSET');
INSERT INTO `location` VALUES ('108', 'GROUND GLOOR - STP');
INSERT INTO `location` VALUES ('109', 'GROUND FLOOR - PERIMETER');
INSERT INTO `location` VALUES ('110', 'MEZZANINE - STORAGE');
INSERT INTO `location` VALUES ('111', 'GROUND FLOOR - ADMISSON OFFICE');
INSERT INTO `location` VALUES ('112', '2ND FLOOR - ELEVATOR ENTRANCE');
INSERT INTO `location` VALUES ('113', '2ND FLOOR - STAIRWAY 1');
INSERT INTO `location` VALUES ('114', '2ND FLOOR - STAIRWAY 2');
INSERT INTO `location` VALUES ('115', '2ND FLOOR - STAIRWAY 3');
INSERT INTO `location` VALUES ('116', '3RD FLOOR - ELEVATOR ENTRANCE');
INSERT INTO `location` VALUES ('117', '3RD FLOOR - STAIRWAY 1');
INSERT INTO `location` VALUES ('118', '3RD FLOOR - STAIRWAY 2');
INSERT INTO `location` VALUES ('119', '3RD FLOOR - STAIRWAY3');
INSERT INTO `location` VALUES ('120', '4TH FLOOR - ELEVATOR ENTRANCE');
INSERT INTO `location` VALUES ('121', '4TH FLOOR - STAIRWAY 1');
INSERT INTO `location` VALUES ('122', '4TH FLOOR - STAIRWAY 2');
INSERT INTO `location` VALUES ('123', '4TH FLOOR - STAIRWAY 3');
INSERT INTO `location` VALUES ('124', '5TH FLOOR - ELEVATOR ENTRANCE');
INSERT INTO `location` VALUES ('125', '5TH FLOOR - STAIRWAY 1');
INSERT INTO `location` VALUES ('126', '5TH FLOOR - STAIRWAY 2');
INSERT INTO `location` VALUES ('127', '5TH FLOOR - STAIRWAY 3');
INSERT INTO `location` VALUES ('128', '6TH FLOOR - ELEVATOR ENTRANCE');
INSERT INTO `location` VALUES ('129', '6TH FLOOR - STAIRWAY 1');
INSERT INTO `location` VALUES ('130', '6TH FLOOR - STAIRWAY 2');
INSERT INTO `location` VALUES ('131', '6TH FLOOR - STAIRWAY 3');
INSERT INTO `location` VALUES ('132', '7TH FLOOR - ELEVATOR ENTRANCE');
INSERT INTO `location` VALUES ('133', '7TH FLOOR - STAIRWAY 1');
INSERT INTO `location` VALUES ('134', '7TH FLOOR - STAIRWAY 2');
INSERT INTO `location` VALUES ('135', '7TH FLOOR - STAIRWAY 3');
INSERT INTO `location` VALUES ('136', '8TH FLOOR - ELEVATOR ENTRANCE');
INSERT INTO `location` VALUES ('137', '8TH FLOOR - STAIRWAY 1');
INSERT INTO `location` VALUES ('138', '8TH FLOOR - STAIRWAY 2');
INSERT INTO `location` VALUES ('139', '8TH FLOOR - STAIRWAY 3');
INSERT INTO `location` VALUES ('140', '9TH FLOOR - 902');
INSERT INTO `location` VALUES ('141', '9TH FLOOR - ELEVATOR ENTRANCE');
INSERT INTO `location` VALUES ('142', '9TH FLOOR - STAIRWAY 1');
INSERT INTO `location` VALUES ('143', '9TH FLOOR - STAIRWAY 2');
INSERT INTO `location` VALUES ('144', '9TH FLOOR - STAIRWAY 3');
INSERT INTO `location` VALUES ('145', 'ELEVATOR 1');
INSERT INTO `location` VALUES ('146', 'ELEVATOR 2');
INSERT INTO `location` VALUES ('147', 'GROUND FLOOR');
INSERT INTO `location` VALUES ('148', 'GROUND FLOOR - STAIRWAY 1');
INSERT INTO `location` VALUES ('149', 'GROUND FLOOR - STAIRWAY 2');
INSERT INTO `location` VALUES ('150', 'MEZZANINE - ELEVATOR ENTRANCE');
INSERT INTO `location` VALUES ('151', 'MEZZANINE - STAIRWAY 1');
INSERT INTO `location` VALUES ('152', 'MEZZANINE - STAIRWAY 2');
INSERT INTO `location` VALUES ('153', 'MEZZANINE - STAIRWAY 3');
INSERT INTO `location` VALUES ('154', 'GROUND FLOOR - COURT');
INSERT INTO `location` VALUES ('155', 'GROUND FLOOR - ENTRANCE');
INSERT INTO `location` VALUES ('156', 'GROUND FLOOR - LOBBY ENTRANCE');
INSERT INTO `location` VALUES ('157', '3RD FLOOR - STORAGE');
INSERT INTO `location` VALUES ('158', '7TH FLOOR - COLD KITCHEN');
INSERT INTO `location` VALUES ('159', '7TH FLOOR - CHEMICAL ROOM');
INSERT INTO `location` VALUES ('160', '9TH FLOOR - PENTHOUSE');
INSERT INTO `location` VALUES ('161', '4TH FLOOR - AUXILLIARY');
INSERT INTO `location` VALUES ('162', '2ND FLOOR - EE');
INSERT INTO `location` VALUES ('163', '3RD FLOOR - 304');
INSERT INTO `location` VALUES ('164', '3RD FLOOR - 312');
INSERT INTO `location` VALUES ('165', '3RD FLOOR - EE');
INSERT INTO `location` VALUES ('166', '4TH FLOOR - 402');
INSERT INTO `location` VALUES ('167', '4TH FLOOR - 403');
INSERT INTO `location` VALUES ('168', '4TH FLOOR - 408A');
INSERT INTO `location` VALUES ('169', '4TH FLOOR - 410');
INSERT INTO `location` VALUES ('170', '7TH FLOOR - PHYSICS GLASS');
INSERT INTO `location` VALUES ('171', 'FACULTY - GLASS');
INSERT INTO `location` VALUES ('172', 'S.A. OFFICE');
INSERT INTO `location` VALUES ('173', 'GROUND ADMIN');
INSERT INTO `location` VALUES ('174', '8TH FLOOR - 802');
INSERT INTO `location` VALUES ('175', 'PHYSICS');
INSERT INTO `location` VALUES ('176', 'GROUND FLOOR ');
INSERT INTO `location` VALUES ('177', '3RD FLOOR - AUXILLIARY');
INSERT INTO `location` VALUES ('178', '6TH FLOOR - ADMIN OFFICE');
INSERT INTO `location` VALUES ('179', '6TH FLOOR');
INSERT INTO `location` VALUES ('180', '6TH FLOOR - AUXILLIARY');
INSERT INTO `location` VALUES ('181', '4TH FLOOR');
INSERT INTO `location` VALUES ('182', '8TH FLOOR - LIBRARY GLASS');
INSERT INTO `location` VALUES ('183', '5TH FLOOR - 501 GLASS');
INSERT INTO `location` VALUES ('184', '2ND FLOOR - 212 GLASS');
INSERT INTO `location` VALUES ('185', 'PAMO');
INSERT INTO `location` VALUES ('186', '6ND FLOOR - 601 GLASS');
INSERT INTO `location` VALUES ('187', '5TH FLOOR - 512 GLASS');
INSERT INTO `location` VALUES ('188', '2ND FLOOR - GLASS');
INSERT INTO `location` VALUES ('189', '4TH FLOOR - GLASS');
INSERT INTO `location` VALUES ('190', '8TH FLOOR - AUXILLIARY');
INSERT INTO `location` VALUES ('191', 'ROOFDECK');
INSERT INTO `location` VALUES ('192', '4TH FLOOR - 404');
INSERT INTO `location` VALUES ('193', '5TH FLOOR - EE');
INSERT INTO `location` VALUES ('194', '9TH FLOOR - 901');
INSERT INTO `location` VALUES ('195', '8TH FLOOR - EE ');
INSERT INTO `location` VALUES ('196', '6TH FLOOR - 609 GLASS');
INSERT INTO `location` VALUES ('197', '3RD FLOOR - 312 GLASS');
INSERT INTO `location` VALUES ('198', '7TH FLOOR STORAGE (KITCHEN)');
INSERT INTO `location` VALUES ('199', '3RD FLOOR - 301 GLASS');
INSERT INTO `location` VALUES ('200', '8TH FLOOR - 805 GLASS');
INSERT INTO `location` VALUES ('201', '2ND FLOOR - ELEVATOR FA?ADE');
INSERT INTO `location` VALUES ('202', 'MEZZANINE - CONSULTATION ROOM');
INSERT INTO `location` VALUES ('203', '6TH FLOOR - EE');
INSERT INTO `location` VALUES ('204', '9TH FLOOR - 902 EE');
INSERT INTO `location` VALUES ('205', '5TH FLOOR - ELEVATOR FACADE');
INSERT INTO `location` VALUES ('206', '3RD FLOOR - EE ');
INSERT INTO `location` VALUES ('207', '2ND FLOOR - AUXILLIARY');
INSERT INTO `location` VALUES ('208', '3RD FLOOR - ELEVATOR');
INSERT INTO `location` VALUES ('209', '8TH FLOOR - EE');
INSERT INTO `location` VALUES ('210', '9TH FLOOR');
INSERT INTO `location` VALUES ('211', '5TH FLOOR - 512');
INSERT INTO `location` VALUES ('212', '2ND FLOOR - 206 ');
INSERT INTO `location` VALUES ('213', '2ND FLOOR - 207');
INSERT INTO `location` VALUES ('214', 'COLD KITCHEN');
INSERT INTO `location` VALUES ('215', '5TH FLOOR - 502');
INSERT INTO `location` VALUES ('216', '5TH FLOOR - 503');
INSERT INTO `location` VALUES ('217', 'GROUND FLOOR - EE');
INSERT INTO `location` VALUES ('218', 'CSG');
INSERT INTO `location` VALUES ('219', '5TH FLOOR - 509');
INSERT INTO `location` VALUES ('220', '4TH FLOOR - EE');
INSERT INTO `location` VALUES ('221', '5TH FLOOR - 511');
INSERT INTO `location` VALUES ('222', '5TH FLOOR - 510');
INSERT INTO `location` VALUES ('223', 'FACULTY');
INSERT INTO `location` VALUES ('224', '5TH FLOOR ELEVATOR');
INSERT INTO `location` VALUES ('225', '5TH FLOOR - 507');
INSERT INTO `location` VALUES ('226', '5TH FLOOR - 505');
INSERT INTO `location` VALUES ('227', '5TH FLOOR - 501');
INSERT INTO `location` VALUES ('228', '5TH FLOOR - 506');
INSERT INTO `location` VALUES ('229', '5TH FLOOR - 504');
INSERT INTO `location` VALUES ('230', '5TH FLOOR - 508');
INSERT INTO `location` VALUES ('231', '8TH FLOOR - STORAGE');
INSERT INTO `location` VALUES ('232', 'GROUND FLOOR - ADMISSION STORAGE');
INSERT INTO `location` VALUES ('233', '7TH FLOOR - 610');
INSERT INTO `location` VALUES ('234', '4TH FLOOR - STORAGE ROOM');
INSERT INTO `location` VALUES ('235', '3RD FLOOR');
INSERT INTO `location` VALUES ('236', 'GROUND FLOOR - MEETING ROOM1');
INSERT INTO `location` VALUES ('237', '9TH FLOOR - STORAGE');
INSERT INTO `location` VALUES ('238', 'GROUND FLOOR - CANTEEN');
INSERT INTO `location` VALUES ('239', '2ND FLOOR - 202 STORAGE');
INSERT INTO `location` VALUES ('240', 'MEZZANINE - E TO E STORAGE');
INSERT INTO `location` VALUES ('241', '2ND FLOOR - 210 STORAGE');
INSERT INTO `location` VALUES ('242', '3RD FLOOR - 302 STORAGE');
INSERT INTO `location` VALUES ('243', '5TH FLOOR -  AUXILLIARY');
INSERT INTO `location` VALUES ('244', '7TH FLOOR -704');
INSERT INTO `location` VALUES ('245', '7TH FLOOR -703');
INSERT INTO `location` VALUES ('246', '7TH FLOOR -702');
INSERT INTO `location` VALUES ('247', 'BORROWED BY SIR ROLAN');
INSERT INTO `location` VALUES ('248', 'GROUND FLOOR - SECURITY OFFICE');
INSERT INTO `location` VALUES ('249', '5TH FLOOR - STORAGE');
INSERT INTO `location` VALUES ('250', 'MEZZANINE - HR OFFICE');
INSERT INTO `location` VALUES ('251', 'HRM BLDG OLD');
INSERT INTO `location` VALUES ('252', 'COURT');
INSERT INTO `location` VALUES ('253', '7TH FLOOR - PHYSICS');
INSERT INTO `location` VALUES ('254', 'MEZZANINIE - E TO E STORAGE');
INSERT INTO `location` VALUES ('255', 'GROUND FLOOR - OPEN AREA BESIDE PAMO');
INSERT INTO `location` VALUES ('256', '5TH FLOOR - AUXILLIARY');
INSERT INTO `location` VALUES ('257', '4TH FLOOR - 402 STORAGE');
INSERT INTO `location` VALUES ('258', 'MEZZANINE - FACULTY CR');
INSERT INTO `location` VALUES ('259', 'GROUND FLOOR - C. R FEMALE');
INSERT INTO `location` VALUES ('260', 'GROUND FLOOR - C.R FEMALE');
INSERT INTO `location` VALUES ('261', 'GROUND FLOOR - CR MALE');
INSERT INTO `location` VALUES ('262', '2ND FLOOR- C. R FEMALE');
INSERT INTO `location` VALUES ('263', 'GROUND FLOOR - CR FEMALE');
INSERT INTO `location` VALUES ('264', '2ND FLOOR - 311');
INSERT INTO `location` VALUES ('265', '2ND FLOOR - 312');
INSERT INTO `location` VALUES ('266', 'MEZZANINE - HALLWAY');
INSERT INTO `location` VALUES ('267', '2ND FLOOR');
INSERT INTO `location` VALUES ('268', '7TH FLOOR');
INSERT INTO `location` VALUES ('269', '8TH FLOOR');
INSERT INTO `location` VALUES ('270', 'MEZZANINE');
INSERT INTO `location` VALUES ('271', 'GROUND FLOOR - LIFT LOBBY');
INSERT INTO `location` VALUES ('272', 'GROUND FLOOR - MAIN LOBBY');
INSERT INTO `location` VALUES ('273', 'GROUND FLOOR - OPEN AREA');
INSERT INTO `location` VALUES ('274', 'MEZZANINE - LIFT LOBBY');
INSERT INTO `location` VALUES ('275', 'MEZZANINE - OLD HR');
INSERT INTO `location` VALUES ('276', 'MEZZANINE - SSA OFFICE');
INSERT INTO `location` VALUES ('277', '7TH FLOOR - CHEMISTRY ROOM');
INSERT INTO `location` VALUES ('278', '5TH FLOOR - 501 STORAGE');
INSERT INTO `location` VALUES ('279', '3RD FLOOR HALLWAY');
INSERT INTO `location` VALUES ('280', '5TH FLOOR - 510 STORAGE');
INSERT INTO `location` VALUES ('281', '6TH FLOOR -  STORAGE');
INSERT INTO `location` VALUES ('282', '6TH FLOOR - EE ROOM');
INSERT INTO `location` VALUES ('283', '5TH FLOOR - EE ROOM');
INSERT INTO `location` VALUES ('284', '7TH FLOOR - HOTEL');
INSERT INTO `location` VALUES ('285', '8TH FLOOR - LIBRARY LOBBY');
INSERT INTO `location` VALUES ('286', '8TH FLOOR - IDF');
INSERT INTO `location` VALUES ('287', ' 4034TH FLOOR -  ');
INSERT INTO `location` VALUES ('288', 'GROUND FLOOR - PUMP ROOM');
INSERT INTO `location` VALUES ('289', '3RD FLOOR - IDF');
INSERT INTO `location` VALUES ('290', 'VACANT AREA');
INSERT INTO `location` VALUES ('291', 'ROOFTOP');
INSERT INTO `location` VALUES ('292', 'GROUND FLOOR - STORAGE');
INSERT INTO `location` VALUES ('293', '2ND FLOOR - CR');
INSERT INTO `location` VALUES ('294', 'CR');
INSERT INTO `location` VALUES ('295', 'GROUND GLOOR - GUARD');
INSERT INTO `location` VALUES ('296', '5TH FLOOR - 404');
INSERT INTO `location` VALUES ('297', '12');

-- ----------------------------
-- Table structure for `major_category`
-- ----------------------------
DROP TABLE IF EXISTS `major_category`;
CREATE TABLE `major_category` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `description` varchar(999) NOT NULL,
  `depreciate_yr` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of major_category
-- ----------------------------
INSERT INTO `major_category` VALUES ('1', 'AVR', '5');
INSERT INTO `major_category` VALUES ('2', 'COMPUTER EQUIPMENT', '5');
INSERT INTO `major_category` VALUES ('3', 'COMPUTER EQUIPMENT SUPPLIES', '5');
INSERT INTO `major_category` VALUES ('4', 'HOUSEKEEPING SUPPLIES', '5');
INSERT INTO `major_category` VALUES ('5', 'KEYBOARD', '5');
INSERT INTO `major_category` VALUES ('6', 'LEASEHOLDS IMPROVEMENTS', '5');
INSERT INTO `major_category` VALUES ('7', 'LICENSE', '5');
INSERT INTO `major_category` VALUES ('8', 'MARKETING SUPPLIES', '5');
INSERT INTO `major_category` VALUES ('13', 'OFFICE FURNITURES AND FIXTURES', '5');
INSERT INTO `major_category` VALUES ('14', 'OFFICE SUPPLIES', '5');
INSERT INTO `major_category` VALUES ('15', 'SCHOOL AND OFFICE EQUIPMENT', '5');
INSERT INTO `major_category` VALUES ('16', 'SCHOOL FURNITURES AND FIXTURES', '5');
INSERT INTO `major_category` VALUES ('17', 'SIGNAGE', '5');
INSERT INTO `major_category` VALUES ('18', 'SMS', '5');
INSERT INTO `major_category` VALUES ('19', 'TRANSPO EQUIPMENT', '5');
INSERT INTO `major_category` VALUES ('20', '12', '123');

-- ----------------------------
-- Table structure for `minor_category`
-- ----------------------------
DROP TABLE IF EXISTS `minor_category`;
CREATE TABLE `minor_category` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `major_id` int(2) NOT NULL,
  `description` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of minor_category
-- ----------------------------
INSERT INTO `minor_category` VALUES ('16', '16', '123');

-- ----------------------------
-- Table structure for `property`
-- ----------------------------
DROP TABLE IF EXISTS `property`;
CREATE TABLE `property` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pcode` varchar(50) DEFAULT NULL,
  `sno` varchar(50) DEFAULT NULL,
  `description` varchar(999) NOT NULL,
  `brand` varchar(99) DEFAULT NULL,
  `model` varchar(99) DEFAULT NULL,
  `minor_category` int(2) NOT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `cost` double(13,2) NOT NULL,
  `date_acquired` datetime NOT NULL,
  `or_number` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of property
-- ----------------------------
INSERT INTO `property` VALUES ('5', 'CLNOSE342014-013', 'BO42CJAF08-05', 'LED PROJECTOR CASIO XJ-A240', '', '', '14', 'PC/S', '40000.00', '2017-01-19 13:59:41', '4010000000493');
INSERT INTO `property` VALUES ('8', 'CLNOSE342014-014', 'B042CJAF08-063596', 'LED Projector CASIO XJ-A240', '', '', '14', 'PC/S', '40000.00', '2017-01-19 14:29:14', '4010000000493');
INSERT INTO `property` VALUES ('9', 'CLNOSE342014-023', 'B042CJAF08-063732', 'LED Projector CASIO XJ-A240', '', '', '14', 'PC/S', '40000.00', '2017-01-19 14:34:06', '4010000000493');
INSERT INTO `property` VALUES ('10', 'CLNOSE342014-040', 'B042CJAF08-064058', 'LED Projector CASIO XJ-A240', '', '', '14', 'PC/S', '40000.00', '2017-01-19 14:37:38', '4010000000493');
INSERT INTO `property` VALUES ('11', 'CLNOSE342014-006', 'B042CJAF08-057432', 'LED Projector CASIO XJ-A240', '', '', '14', 'PC/S', '40000.00', '2017-01-19 14:41:13', '4010000000493');
INSERT INTO `property` VALUES ('12', 'CLNOSE342014-021', 'B042CJAF08-063710', 'LED Projector CASIO XJ-A240', '', '', '14', 'PC/S', '40000.00', '2017-01-19 14:47:29', '4010000000493');
INSERT INTO `property` VALUES ('15', '1', '1', '1', '1', '1', '0', '1', '1.00', '2017-01-31 16:02:49', '1');

-- ----------------------------
-- Table structure for `property_accountability`
-- ----------------------------
DROP TABLE IF EXISTS `property_accountability`;
CREATE TABLE `property_accountability` (
  `emp_id` varchar(30) NOT NULL,
  `property_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `condition_id` int(2) NOT NULL,
  `remarks` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`emp_id`,`condition_id`,`property_id`,`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of property_accountability
-- ----------------------------
INSERT INTO `property_accountability` VALUES ('CLN0083A', '10', '0', '0', '0', null);

-- ----------------------------
-- Table structure for `sub_property`
-- ----------------------------
DROP TABLE IF EXISTS `sub_property`;
CREATE TABLE `sub_property` (
  `property_id` int(11) NOT NULL,
  `sub_property_id` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`sub_property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sub_property
-- ----------------------------

-- ----------------------------
-- Table structure for `sub_property_history`
-- ----------------------------
DROP TABLE IF EXISTS `sub_property_history`;
CREATE TABLE `sub_property_history` (
  `property_id` int(11) NOT NULL,
  `sub_property_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sub_property_history
-- ----------------------------

-- ----------------------------
-- Table structure for `temp_property_accountability`
-- ----------------------------
DROP TABLE IF EXISTS `temp_property_accountability`;
CREATE TABLE `temp_property_accountability` (
  `pcode` varchar(50) NOT NULL,
  PRIMARY KEY (`pcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of temp_property_accountability
-- ----------------------------
INSERT INTO `temp_property_accountability` VALUES ('CLNOSE14-2014-003');
INSERT INTO `temp_property_accountability` VALUES ('CLNOSE342014-001');
INSERT INTO `temp_property_accountability` VALUES ('CLNOSE342014-013');

-- ----------------------------
-- Table structure for `transfer_request`
-- ----------------------------
DROP TABLE IF EXISTS `transfer_request`;
CREATE TABLE `transfer_request` (
  `request_code` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `condition_id` int(2) NOT NULL,
  `old_loc_id` int(11) NOT NULL,
  `new_loc_id` int(11) NOT NULL,
  `transfer_to` varchar(30) NOT NULL,
  `released_from` varchar(30) NOT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `date_request` datetime NOT NULL,
  `emp_approval` int(1) NOT NULL,
  PRIMARY KEY (`id`,`condition_id`,`old_loc_id`,`released_from`,`request_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transfer_request
-- ----------------------------

-- ----------------------------
-- Table structure for `transfer_request_history`
-- ----------------------------
DROP TABLE IF EXISTS `transfer_request_history`;
CREATE TABLE `transfer_request_history` (
  `ctrl_no` varchar(30) NOT NULL,
  `sy` varchar(4) NOT NULL,
  `no` int(11) NOT NULL,
  `request_code` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `condition_id` int(2) NOT NULL,
  `old_loc_id` int(11) NOT NULL,
  `new_loc_id` int(11) NOT NULL,
  `transfer_to` varchar(30) NOT NULL,
  `released_from` varchar(30) NOT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `date_approved` datetime NOT NULL,
  PRIMARY KEY (`id`,`condition_id`,`old_loc_id`,`released_from`,`ctrl_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transfer_request_history
-- ----------------------------
INSERT INTO `transfer_request_history` VALUES ('CLN-1617-00002O', '1617', '2', '1', '6', '1', '1', '12', '12', 'CLN0291A', 'CLN0025A', null, '2017-01-25 10:07:05');
INSERT INTO `transfer_request_history` VALUES ('CLN-1617-00001O', '1617', '1', '1', '7', '1', '1', '11', '11', 'CLN0291A', 'CLN0025A', null, '2017-01-25 09:23:32');
INSERT INTO `transfer_request_history` VALUES ('CLN-1617-00002O', '1617', '2', '1', '8', '1', '1', '13', '11', 'CLN0291A', 'CLN0025A', null, '2017-01-25 10:07:05');
INSERT INTO `transfer_request_history` VALUES ('CLN-1617-00002O', '1617', '2', '1', '9', '1', '1', '14', '11', 'CLN0291A', 'CLN0025A', null, '2017-01-25 10:07:05');
INSERT INTO `transfer_request_history` VALUES ('CLN-1617-00003O', '1617', '3', '1', '13', '1', '1', '18', '13', 'CLN0291A', 'CLN0025A', null, '2017-01-27 15:53:22');

-- ----------------------------
-- View structure for `propertyaccountability`
-- ----------------------------
DROP VIEW IF EXISTS `propertyaccountability`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `propertyaccountability` AS select `a`.`property_id` AS `id`,`b`.`pcode` AS `pcode`,`b`.`sno` AS `sno`,`b`.`description` AS `description`,`c`.`location` AS `location`,`d`.`condition_info` AS `condition_info`,`a`.`emp_id` AS `emp_id`,`e`.`department` AS `department`,`a`.`qty` AS `qty`,`a`.`condition_id` AS `condition_id`,`b`.`uom` AS `uom`,`a`.`location_id` AS `location_id`,concat(`e`.`last_name`,', ',`e`.`first_name`) AS `emp_name` from ((((`property_accountability` `a` left join `property` `b` on((`a`.`property_id` = `b`.`id`))) left join `location` `c` on((`a`.`location_id` = `c`.`id`))) left join `condition_info` `d` on((`a`.`condition_id` = `d`.`id`))) join `account_table` `e` on((`a`.`emp_id` = `e`.`emp_id`)));

-- ----------------------------
-- View structure for `propertymainteview`
-- ----------------------------
DROP VIEW IF EXISTS `propertymainteview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `propertymainteview` AS select `property`.`id` AS `id`,`property`.`pcode` AS `pcode`,`property`.`sno` AS `sno`,`property`.`description` AS `description`,`property`.`brand` AS `brand`,`property`.`model` AS `model`,`property`.`minor_category` AS `minor_category`,`property`.`uom` AS `uom`,`property`.`cost` AS `cost`,`property`.`date_acquired` AS `date_acquired`,`property`.`or_number` AS `or_number`,`property_accountability`.`qty` AS `qty`,`major_category`.`depreciate_yr` AS `depreciate_yr` from (((`property` left join `minor_category` on((`property`.`minor_category` = `minor_category`.`id`))) left join `major_category` on((`minor_category`.`major_id` = `major_category`.`id`))) left join `property_accountability` on((`property`.`id` = `property_accountability`.`property_id`)));
