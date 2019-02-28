SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE educacionmedia.etapas_proceso;
INSERT INTO educacionmedia.etapas_proceso (id, nombre, descripcion, apertura, cierre, created_at, updated_at)
VALUES (1, 'AFORO', 'AFORO', '2017-12-31', '2018-12-30', '2019-02-28 13:37:53', '2019-02-28 13:37:53');
INSERT INTO educacionmedia.etapas_proceso (id, nombre, descripcion, apertura, cierre, created_at, updated_at)
VALUES (2, 'OFERTA', 'OFERTA', '2017-12-31', '2018-12-30', '2019-02-28 13:37:53', '2019-02-28 13:37:53');
INSERT INTO educacionmedia.etapas_proceso (id, nombre, descripcion, apertura, cierre, created_at, updated_at)
VALUES (3, 'REGISTRO', 'REGISTRO', '2017-12-31', '2018-12-30', '2019-02-28 13:37:53', '2019-02-28 13:37:53');
SET FOREIGN_KEY_CHECKS = 1;
