# kagati

Question 1: Visualize Solution and PHP Coding

Flowchart : task1.pdf
MySQL database schema : kagati.sql
PHP functions : task1.php

Question 2: MySQL Query
select count(distinct(o.Order_ID)) as Number_Of_Order, sum(case when o.Sales_Type='Normal' then Normal_Price else Promotion_Price end) as Total_Sales_Amount from Orders_Products join Orders as o on o.Order_ID=Orders_Products.Order_ID

Question 3: Calculation
Let take order amount as x
x + (6% of x) = MYR 5
i.e x + (6/100 * x) = 5
=>	106x/100 = 5
=>	106x = 500 MYR
=>	x = (500/106) MYR
=>	x = 4.72

So GST = 5 - 4.72 = 0.28 //Ans
