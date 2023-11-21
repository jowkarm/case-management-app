/**
  Alternative table with only student_id AS the ctclink_id
 */

DROP TABLE students; #only if you want to delete the table you already have.

CREATE TABLE students (
                          student_id INT(9) NOT NULL PRIMARY KEY,
                          first_name VARCHAR(30) NOT NULL,
                          middle_name VARCHAR(30),
                          last_name VARCHAR(30) NOT NULL,
                          pronouns VARCHAR(10),
                          tribe VARCHAR(45),
                          cte_program VARCHAR(45),
                          email VARCHAR(45),
                          phone VARCHAR(10),
                          clothing_size VARCHAR(10),
                          course_history BLOB(500),
                          academics BLOB(500),
                          notes BLOB(500)
);

#INSERT dummy data (NOT EUROPEAN-AMERICAN data! -> to change tech, change the default)
#This does not include course_history, academics, or notes, those can only be added with the set methods
INSERT INTO students (student_id, first_name, middle_name, last_name, pronouns, tribe,
                      cte_program, email, phone, clothing_size)
VALUES
        (876594783, 'DPharoah', NULL, 'Woon_A-Tai', 'he/him', 'Muckleshoot Indian Tribe',
         'Forest Resource Management, BAS', 'woonatai.dph@student.greenriver.edu', '2538456935', 'm'),
        (245712544, 'Devery', NULL, 'Jacobs', 'she/her', 'Cherokee Nation',
         'Forest Resource Management, BAS', 'jacobs.dev@student.greenriver.edu', NULL, 's'),
        (144125636, 'Pauline', NULL, 'Alexis', 'she/her', 'Muckleshoot Indian Tribe',
         'Forestry, AAS, BAS', 'alexis.pau@student.greenriver.edu', NULL, 'm'),
        (154296428, 'Lane', NULL, 'Factor', 'he/him', 'Muckleshoot Indian Tribe',
         'Geographic Information Systems, AAS', 'factor.lane@student.greenriver.edu', NULL, 'xl'),
        (775412356, 'Elva', NULL, 'Guerra', 'she/her', 'Suquamish TribeM',
         'Forest Resource Management, BAS', 'guerra.elva@student.greenriver.edu', NULL, 'm'),
        (415679543, 'Sarah', NULL, 'Podemski', 'she/her', 'Suquamish Tribe',
         'Water Quality, AAS', 'podemski.sarah@student.greenriver.edu', NULL, 's'),
        (456785658, 'Zahn', NULL, 'McClarnon', 'he/him', 'Snoqualmie',
         'Wildland Fire, AAS', 'mclarnon.zahn@student.greenriver.edu', NULL, 'l')
;


#INSERT single student record
INSERT INTO students (student_id, first_name, middle_name, last_name, pronouns, tribe, cte_program, email, phone, clothing_size)
VALUES (
    876594783, 'DPharoah', NULL, 'Woon_A-Tai', 'he/him', 'Muckleshoot Indian Tribe',
    'Forest Resource Management, BAS', 'woonatai,dph@student.greenriver.edu', NULL, 'm'
);


#UPDATE single record


#DELETE single record






