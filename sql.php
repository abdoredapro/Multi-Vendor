<?php

    // get unique column like name
    // SELECT DISTINCT(name) FROM city

    // SELECT COUNT(name) - COUNT(DISTINCT name) FROM admins;


    // joins
    // - SELECT orders.number, orders.payment_status, users.name, users.email
    // FROM orders
    // INNER JOIN users ON orders.user_id = users.id

    // - SELECT number, payment_status, name, email
    // FROM orders
    // INNER JOIN users ON orders.user_id = users.id

// ** INNER JOIN keyword returns only rows with a match in both tables .

// left join 

// --- SELECT name, users.id, email, orders.status FROM users LEFT JOIN orders ON users.id = orders.user_id;


/*  SELECT name, email, orders.number, orders.payment_method
    FROM users
    LEFT JOIN orders ON orders.user_id = users.id
*/

/*  -- Right JOIN
        --- SELECT Orders.OrderID, Employees.LastName, Employees.FirstName
        FROM Orders
        RIGHT JOIN Employees ON Orders.EmployeeID = Employees.EmployeeID
        ORDER BY Orders.OrderID;


        Note: The LEFT JOIN keyword returns all records from the left table (Customers), even if there are no matches in the right table (Orders).
    
*/
/*  FULL OUTER JOIN */


/*  -- group by
    --- SELECT COUNT(store_id), payment_method
    FROM orders
    GROUP BY payment_method
*/