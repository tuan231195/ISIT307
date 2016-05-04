<?php if (!defined('PATH_SYSTEM')) die ('Bad request!');

class Index_Controller extends Base_Controller
{
    public function indexAction()
    {
        $schoolDao = $this->dao->load("school");
        $professorDao = $this->dao->load("professor");
        $data = array();
        if(isset($_GET['keyword']))
        {
            $schools = $schoolDao->getSchoolsByKeywords($_GET['keyword']);
        }
        else
        {
            $schools = $schoolDao->getSchools();
        }

        $data['schools'] = $schools;
        $data['page'] = "home";
        $data['title'] = "Home Page";

        for ($i = 0; $i < count($data['schools']); $i++) {
            $data['schools'][$i]['professors'] = $professorDao->getProfessorsFromSchool($data['schools'][$i]['schoolname']);
        }
        $this->view->load("index", $data);
    }

    public function departmentAction()
    {
        $departmentDao = $this->dao->load("departments");
        if (isset($_GET['school'])) {
            $d = $_GET['school'];
            $departments = $departmentDao->getDepartmentsFromSchool($d);
        } else {
            $departments = $departmentDao->getDepartments();
        }
        $data['departments'] = $departments;
        $data['page'] = "departments";
        $data['title'] = "Departments";
        $this->view->load("department", $data);
    }


    public function courseAction()
    {
        $coursesDao = $this->dao->load("course");
        if (isset($_GET['keyword'])) {
            $courses = $coursesDao->getCoursesByKeywords($_GET['keyword']);
        }
        else {
            if (isset($_GET['department'])) {
                $d = $_GET['department'];
                $courses = $coursesDao->getCoursesFromDepartment($d);
            } else {
                $courses = $coursesDao->getCourses();
            }

        }
        $data['courses'] = $courses;
        for ($i = 0; $i < count($data['courses']); $i++) {
            $data['courses'][$i]['num_classes'] = $coursesDao->getNumClasses($data['courses'][$i]['coursename']);
            $data['courses'][$i]['num_students'] = $coursesDao->getNumStudents($data['courses'][$i]['coursename']);
        }
        $data['page'] = "courses";
        $data['title'] = "Courses";
        $this->view->load("courses", $data);
    }

    public function enrolledAction()
    {
        if (!isset($_SESSION))
        {
            session_start();
        }
        if (!isset($_SESSION['user']))
        {
            header('Location: index.php');
            exit(0);
        }
        $classDao = $this->dao->load("classes");
        $data = array();
        $data['classes'] = $classDao->getClassesTakenByStudent($_SESSION['user']);
        $data['page'] = "enrolled";
        $data['title'] = "Enrolled Classes";
        for ($i = 0; $i < count($data['classes']); $i++) {
            $data['classes'][$i]['num_students'] = $classDao->getNumStudents($data['classes'][$i]['classcode']);
        }

        $this->view->load("enrollment", $data);
    }

    public function enquiryAction(){
        if (!isset($_SESSION))
        {
            session_start();
        }
        if (!isset($_SESSION['user']))
        {
            header('Location: index.php');
            exit(0);
        }
        $data = array();
        $data['page'] = "enquiry";
        $data['title'] = "Enquiry";
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $this->view->load("enquiry", $data);
        }
        else{
            if (!empty($_POST["email"]))
            {
                if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $data["email"] = $_POST['email'];
                }
                else{
                    $data['email_error'] = "Invalid email";
                }

            }
            else
            {
                $data['email_error'] = "Email must not be empty";
            }
            if (!empty($_POST["subject"]))
            {
                $data["subject"] = $_POST['subject'];
            }
            else{
                $data['subject_error'] = "Subject must not be empty";
            }
            if (!empty($_POST['detail']))
            {
                $data["detail"] = $_POST['detail'];
            }
            else{
                $data['detail_error'] = "Detail must not be empty";
            }
            if (isset($data["detail"]) && isset($data["subject"]) && isset($data["email"]))
            {
                $to = "vdtn359@uowmail.edu.au";
                $subject = $data["subject"] ;
                $content = $data["detail"];
                $headers = "From:". $data["email"];
                mail($to, $subject, $content, $headers);
                $data["message"] = "Message delivered successfully";
                $this->view->load("enquiry", $data);
            }
            else{
                $this->view->load("enquiry", $data);
            }



        }
    }

    public function classAction()
    {
        $classDao = $this->dao->load("classes");
        $data = array();
        if (isset($_GET['offset']) && is_numeric($_GET['offset'])) {
            $offset = $_GET['offset'];
        } else {
            $offset = 0;
        }

        $num_items = 5;
        $total = 0;
        if (isset($_GET['coursename'])) {
            $coursename = $_GET['coursename'];
            $classes = $classDao->getClassesFromCourse($coursename, $offset, $num_items, $total);
        } else {
            $classes = $classDao->getClasses($offset, $num_items, $total);
        }
        $data['count'] = $total;
        $data['active'] = (int)($offset / $num_items);
        $data['num_items'] = $num_items;
        $data['num_pages'] = ceil($total / $num_items);

        $data['page'] = "classes";
        $data['title'] = "Classes";
        $data['classes'] = $classes;
        for ($i = 0; $i < count($data['classes']); $i++) {
            $data['classes'][$i]['num_students'] = $classDao->getNumStudents($data['classes'][$i]['classcode']);
        }
        $this->view->load("classes", $data);

    }


    public function professorAction()
    {
        $professorDao = $this->dao->load("professor");
        $classesDao = $this->dao->load("classes");
        $studentDao = $this->dao->load("students");
        $data = array();
        if (isset($_GET['keyword']))
        {
            $keyword = $_GET['keyword'];
            $data['page'] = "professors";
            $data['title'] = "Professors";
            if (isset($_GET['offset']) && is_numeric($_GET['offset'])) {
                $offset = $_GET['offset'];
            } else {
                $offset = 0;
            }
            $num_items = 5;
            $total = 0;
            $data['professors'] = $professorDao->getProfessorByKeywords($keyword, $offset, $num_items, $total);
            $data['count'] = $total;
            $data['active'] = (int)($offset / $num_items);
            $data['num_items'] = $num_items;
            $data['num_pages'] = ceil($total / $num_items);
            $this->view->load("professor", $data);
            return;
        }
        if (!isset($_GET['professorId'])) {

            $data['page'] = "professors";
            $data['title'] = "Professors";

            if (isset($_GET['offset']) && is_numeric($_GET['offset'])) {
                $offset = $_GET['offset'];
            } else {
                $offset = 0;
            }
            $num_items = 5;
            $total = 0;
            $data['professors'] = $professorDao->getProfessors($offset, $num_items, $total);
            $data['count'] = $total;
            $data['active'] = (int)($offset / $num_items);
            $data['num_items'] = $num_items;
            $data['num_pages'] = ceil($total / $num_items);
            $this->view->load("professor", $data);
        } else {
            $data['professor'] = $professorDao->getProfessor($_GET['professorId'])[0];
            $data['page'] = "professors";
            $data['title'] = "Professor details";
            $data['professor']['students'] = $studentDao->getStudentsTaughtByProfessor($data['professor']['professorid']);
            $data['professor']['classes'] = $classesDao->getClassesTaughtByProfessor($data['professor']['professorid']);
            $this->view->load("professor_details", $data);
        }
    }


}