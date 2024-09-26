<?php
include "../components/kanban.php";
//include "../components/head.php";
include "../components/header.php";

head("الصفحة الرئيسية");
session_start();


$user = unserialize($_SESSION['user']);
$Tasks = Model\Task::All();
$statuses = Model\Status::All();
$groups = Model\Group::All();
$priorities = Model\Priority::All();
$types = Model\Type::All();
include "../components/add-task.php";

?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap');

    * {
        margin: 0;
        padding: 0;
        text-decoration: none;
        list-style: none;
        box-sizing: border-box;
    }

    .dashboard {
        display: grid;
        grid-template-columns: 78% auto 20%;
    }

    html {
        font-size: 14px;
        scroll-behavior: smooth;
    }

    body {
        font-family: 'Poppins', sans-serif;
        font-size: .88rem;
        user-select: none;
        overflow-x: hidden;
    }


    img {
        display: block;
        width: 100%;
    }

    h1 {
        font-weight: 800;
        font-size: 1.8rem;
    }

    h2 {
        font-size: 1.4rem;
    }

    h3 {
        font-size: .87rem;
    }

    h4 {
        font-size: .8rem;
    }

    h5 {
        font-size: .77rem;
    }

    small {
        font-size: .75rem;
    }



    .primary {
        color: var(--color-primary);
    }

    .danger {
        color: var(--color-danger);
    }

    .success {
        color: var(--color-success)
    }

    .warning {
        color: var(--color-warning);
    }

    .sp-container {

        padding-top: 1rem;
    }

    header h3 {
        font-weight: 500;
    }

    header {
        position: fixed;
        width: 100vw;
        z-index: 1000;
        background-color: var(--color-background);
    }

    header.active {
        box-shadow: var(--box-shadow);
    }

    header .logo {
        display: flex;
        gap: .8rem;
        margin-right: auto;
        text-align: right;
    }

    header .logo img {
        width: 3.8rem;
        height: 3.8rem;
    }

    header,
    header .navbar {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 3rem;
        color: var(--color-info);
    }

    header .navbar a {
        display: flex;
        margin-left: 2rem;
        gap: 1rem;
        align-items: center;
        justify-content: space-between;
        position: relative;
        height: 3.7rem;
        transition: all 300ms ease;
        padding: 0 2rem;
    }

    header .navbar a:hover {
        padding-top: 1.5rem;
    }

    header .navbar a.active {
        background: var(--color-light);
        color: var(--color-primary);
    }

    header .navbar a.active::before {
        content: "";
        background-color: var(--color-primary);
        position: absolute;
        height: 5px;
        width: 100%;
        left: 0;
        top: 0;
    }

    header #profile-btn {
        display: none;
        font-size: 2rem;
        margin: .5rem 2rem 0 0;
        cursor: pointer;
    }

    /* 
    header .theme-toggler {
        background: var(--color-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 1.6rem;
        width: 4.2rem;
        cursor: pointer;
        border-radius: var(--border-radius-1);
        margin-right: 2rem;
    }

    header .theme-toggler span {
        font-size: 1.2rem;
        width: 50%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    header .theme-toggler span.active {
        background-color: var(--color-primary);
        color: white;
        border-radius: var(--border-radius-1);
    } */

    .button-container {
        position: fixed;
        right: 57%;
        bottom: 10px;
        display: flex;
        /* استخدام flexbox لتوزيع الأزرار أفقيًا */
        gap: 10px;
        /* إضافة مسافة 10px بين الأزرار */
    }

    .btn-custom {
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
    }

    /* Profile section */
    .test .profile {
        margin-top: 2rem;
        width: 13rem;
    }

    .test .profile .top {
        display: flex;
        align-items: center;
        gap: 1rem;
        border-bottom: 1px solid var(--color-light);
        padding-bottom: 1rem;
    }

    .test .profile .top:hover .profile-photo {
        scale: 1.05;
    }

    .test .profile .top .profile-photo {
        width: 6rem;
        height: 6rem;
        border-radius: 50%;
        overflow: hidden;
        border: 5px solid var(--color-light);
        transition: all 400ms ease;
    }



    /* Home Section */
    main {
        display: flex;
        padding-top: 50px;
        height: 160px;
        justify-content: space-evenly;
        width: 80%;
    }

    .right .statistics .teacher {

        border-radius: var(--border-radius-2);
        box-shadow: var(--box-shadow);
    }

    .right .statistics .teacher:hover {
        box-shadow: none;
    }

    .right {
        width: fit-content;
        height: 500px;
        overflow: auto;
    }


    .right::-webkit-scrollbar {
        width: 8px;
    }

    .right::-webkit-scrollbar-track {
        background: rgb(213, 213, 213);
        box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;

    }

    .right::-webkit-scrollbar-thumb {
        background: gray;
        border-radius: 10px;
    }





    /* MEDIA QUERIES */
    @media screen and (max-width: 1200px) {
        html {
            font-size: 12px;
        }

        header {
            position: fixed;
        }

        .sp-container {
            padding-top: 1rem;
        }

        header .logo h2 {
            display: none;
        }

        header .navbar h3 {
            display: none;
        }

        header .navbar a {
            width: 4.5rem;
            padding: 0 1rem;
        }

    }


    @media screen and (max-width: 768px) {
        html {
            font-size: 10px;
        }

        header {
            padding: 0 .8rem;
        }

        .sp-container {
            width: 100%;
            grid-template-columns: 1fr;
            margin: 0;
        }

        header #profile-btn {
            display: inline;
        }

        header .navbar {
            padding: 0;
        }

        header .navbar a {
            margin: 0 .5rem 0 0;
        }

        .test {
            /* position: absolute; */
            top: 4rem;
            left: 0;
            right: 0;
            padding-left: 2rem;
            transform: translateX(-100%);
            z-index: 10;
            width: 18rem;
            display: inline-block;
            box-shadow: 1rem 3rem 4rem var(--color-light);
            transition: all 2s ease;
        }

        .test.active {
            transform: translateX(0);
        }

        main {
            padding: 0 2rem;
        }

    }
</style>

<body data-bs-theme="light">
    <?php headerOfPage(); ?>
    <?php if ($user->isManager()) { ?>
        <main>
            <div class="test" style="height: 70px;">
                <div class="profile">
                    <div class="top">
                        <div class="profile-photo" style="height:auto">
                            <img src="<?= $user->getImg() ?>" alt="">
                        </div>
                        <?php $user_id = $user->getUserId() ?>
                        <div class="info">
                            <p>مرحبا, <b><?= $user->getFirstName() ?></b> </p>
                            <small class="text-muted"><?= $user_id ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <a id="status" class="btn btn-outline-success p-2 rounded-2 m-3 text-decoration-none" data-bs-theme="light" href="?getBy=status">
                <h1 style="line-height: 60px">حالات المهام</h1>
            </a>
            <a id="group" class="btn btn-outline-success p-2 rounded-2 m-3 text-decoration-none" data-bs-theme="light" href="?getBy=group">
                <h1 style="line-height: 60px">المجموعات</h1>
            </a>
            <a id="type" class="btn btn-outline-success p-2 rounded-2 m-3 text-decoration-none" data-bs-theme="light" href="?getBy=type">
                <h1 style="line-height: 60px">أنواع المهام</h1>
            </a>
            <a id="priority" class="btn btn-outline-success p-2 rounded-2 m-3 text-decoration-none" data-bs-theme="light" href="?getBy=priority">
                <h1 style="line-height: 60px">أهمية المهام</h1>
            </a>
            <script>
                const searchParams = new URLSearchParams(window.location.search);
                var getBy = searchParams.get('getBy');

                var As = document.querySelectorAll('main > a');

                for (let i = 0; i < As.length; i++) {
                    //console.log(As[i].id);
                    if (As[i].id == getBy) {
                        As[i].classList.toggle('btn-outline-success');
                        As[i].classList.add('btn-outline-warning');
                    }
                }
            </script>
        </main>
        <div class="dashboard">
            <div class="sp-container">
                <div>
                    <?php if (isset($_GET['getBy'])) {
                        if ($_GET['getBy'] == 'status') {
                    ?>
                            <div class="kanban-container">
                                <div class="">
                                    <div class='e-offset-12 e-offset-md-3 e-offset-lg-2'>
                                        <?php
                                        //var_dump($statuses);
                                        foreach ($statuses as $status) {
                                            kanban('status', $status[0], $user_id);
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else if ($_GET['getBy'] == 'group') {
                        ?>
                            <div class="kanban-container">
                                <div class=" ">
                                    <div class='e-offset-12 e-offset-md-3 e-offset-lg-2'>
                                        <?php
                                        //var_dump($statuses);
                                        foreach ($groups  as $group) {
                                            kanban('group', $group[0], $user_id);
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else if ($_GET['getBy'] == 'type') {
                        ?>
                            <div class="kanban-container">
                                <div class=" ">
                                    <div class='e-offset-12 e-offset-md-3 e-offset-lg-2'>
                                        <?php
                                        //var_dump($statuses);
                                        foreach ($types  as $type) {
                                            kanban('type', $type[0], $user_id);
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else if ($_GET['getBy'] == 'priority') {
                        ?>
                            <div class="kanban-container">
                                <div class=" ">
                                    <div class='e-offset-12 e-offset-md-3 e-offset-lg-2'>
                                        <?php
                                        //var_dump($statuses);
                                        foreach ($priorities  as $priority) {
                                            kanban('priority', $priority[0], $user_id);
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="kanban-container">
                            <div class=" ">
                                <div class='e-offset-12 e-offset-md-3 e-offset-lg-2'>
                                    <?php
                                    //var_dump($statuses);
                                    foreach ($statuses as $status) {

                                        kanban('status', $status[0], $user_id);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php

                    }
                } ?>
                </div>
            </div>
            <div></div>
            <div class="right">
                <div class="statistics">
                    <h2>إحصائيات</h2>
                    <div class="teacher bg-light" style="width:250px;height:250px;">
                        <div class="">
                            <h3 class="ms-2 mt-2">مهام الشهر الجاري</h3>
                            <?php
                            $today = date("d", gettimeofday()['sec']);
                            $first_day = gettimeofday()['sec'] - (60 * 60 * 24 * $today);
                            $first_day = date("Y-m-d", $first_day);
                            $now = date("Y-m-d", gettimeofday()['sec']);
                            $total = Model\Task::countPeriod('assigned_at', $first_day, $now);
                            $getThem = Model\Task::getPeriod('assigned_at', $first_day, $now);
                            $Completed = 0;
                            foreach ($getThem as $row) {
                                if ($row['progress'] == 100)
                                    $Completed++;
                            }
                            ?>
                            <div style="height:10rem">
                                <canvas id="myChart"></canvas>
                            </div>
                            <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
                            <script>
                                const ctx = document.getElementById('myChart');
                                new Chart(ctx, {
                                    type: 'doughnut',
                                    data: {
                                        datasets: [{
                                            data: [<?= $Completed ?>, <?= $total - $Completed ?>],
                                            backgroundColor: [
                                                '<?= $Completed > $total / 2 ? "rgb(20, 200, 20)" : "rgb(200, 20, 20)" ?>',
                                                'rgba(255, 255, 255,0)'

                                            ],

                                        }]
                                    }
                                });
                            </script>
                            <div class="d-inline-block p-2">
                                <p><?= $Completed > 10 ? $Completed . " مهمة منجزة" : $Completed . " مهام منجزة" ?></p>
                                <p><?= $total > 10 ? "من $total مهمة" : "من $total مهام" ?></p>
                            </div>
                            <?php //Model\Task::countPeriod('assigned_at',   $first_day, $now) 
                            ?>
                        </div>
                    </div>
                    <?php $GroupsCounter = 0;
                    foreach ($groups as $Group) {
                        $today = date("d", gettimeofday()['sec']);
                        $first_day = gettimeofday()['sec'] - (60 * 60 * 24 * $today);
                        $first_day = date("Y-m-d", $first_day);
                        //    alerter($first_day);
                        $now = date("Y-m-d", gettimeofday()['sec']);
                        //    alerter($now);
                        $GruopTasks = Model\Task::findColumns(['group_id', 'assigned_at', 'assigned_at'], [$Group['group_id'], $first_day, $now], ["=", ">", "<"], "AND");
                        $total = count($GruopTasks);
                        $Completed = 0;
                        if ($total == 0) {
                            continue;
                        }

                    ?>

                        <div class="teacher bg-light" style="width:250px;height:250px;">
                            <div class="">
                                <h3 class="ms-2 mt-2">(<?= $Group['group'] ?>) مهام الشهر الجاري</h3>
                                <?php

                                foreach ($GruopTasks as $row) {
                                    if ($row['progress'] == 100)
                                        $Completed++;
                                }
                                ?>
                                <div style="height:10rem">
                                    <canvas id='myChart<?= $GroupsCounter ?>'></canvas>
                                </div>
                                <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
                                <script>
                                    const ctx<?= $GroupsCounter ?> = document.getElementById('myChart<?= $GroupsCounter ?>');
                                    new Chart(ctx<?= $GroupsCounter++ ?>, {
                                        type: 'doughnut',
                                        data: {
                                            datasets: [{
                                                data: [<?= $Completed ?>, <?= $total - $Completed ?>],
                                                backgroundColor: [
                                                    '<?= $Completed > $total / 2 ? "rgb(20, 200, 20)" : "rgb(200, 20, 20)" ?>',
                                                    'rgba(255, 255, 255,0)'

                                                ],

                                            }]
                                        }
                                    });
                                </script>
                                <div class="d-inline-block p-2">
                                    <p><?= $Completed > 10 ? $Completed . " مهمة منجزة" : $Completed . " مهام منجزة" ?></p>
                                    <p><?= $total > 10 ? "من $total مهمة" : "من $total مهام" ?></p>
                                </div>
                                <?php //Model\Task::countPeriod('assigned_at',   $first_day, $now) 
                                ?>
                            </div>
                        </div>
                    <?php  } ?>
                </div>

            </div>

        </div>
        <div data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-primary rounded-5 p-3" style="box-shadow:0px 0px 5px rgba(0,0,0,0.5); position: fixed; right:85%;bottom:10px;"> إضافة مهمة&nbsp;&nbsp;<i class="fa fa-plus"></i></div>
        <div class="button-container">
            <a href="viowusers.php" class="btn btn-warning rounded-5 p-3 btn-custom">
                الموظفين&nbsp;&nbsp;<i class="fa fa-plus"></i>
            </a>
            <a href="priority_viow.php" class="btn btn-secondary rounded-5 p-3 btn-custom">
                الحالات&nbsp;&nbsp;<i class="fa fa-plus"></i>
            </a>
            <a href="viowgroup.php" class="btn btn-success rounded-5 p-3 btn-custom">
                المجموعات&nbsp;&nbsp;<i class="fa fa-plus"></i>
            </a>
            <a href="type_viow.php" class="btn btn-info rounded-5 p-3 btn-custom">
                النوع&nbsp;&nbsp;<i class="fa fa-plus"></i>
            </a>
        </div>
        <?php //s 
        ?>
</body>
<?php scripts(); ?>