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
        $classDao = $this->dao->load("classes");
        $data['classes'] = $classDao->getClassesTakenByStudent($_SESSION['user']);
        $data['page'] = "enrolled";
        $data['title'] = "Enrolled Classes";
        for ($i = 0; $i < count($data['classes']); $i++) {
            $data['classes'][$i]['num_students'] = $classDao->getNumStudents($data['classes'][$i]['classcode']);
        }

        $this->view->load("enrolled", $data);
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