CREATE TABLE dishes (
    dish_id INT,
    dish_name   VARCHAR(255),
    price   DECIMAL(4,2),
    is_spicy    INT   
)

INSERT INTO dishes VALUES (1, '호두 번', 1.00, 0)
INSERT INTO dishes VALUES (2, '캐슈너트와 양송이버섯', 4.95, 0)
INSERT INTO dishes VALUES (3, '말린 오디', 3.00, 0)
INSERT INTO dishes VALUES (4, '칠리소스 가지 볶음', 6.50, 1)
INSERT INTO dishes VALUES (5, '단팥 번', 1.00, 0)
INSERT INTO dishes VALUES (6, '''특별''한 치킨', 5.50, 1)