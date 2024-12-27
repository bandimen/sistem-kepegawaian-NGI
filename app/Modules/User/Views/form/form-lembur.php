<!doctype html>
<html lang="en">

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>

</head>

<?= $this->include('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Textual inputs</h4>
                                <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each
                                    textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                            </div>
                            <div class="card-body p-4">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Text</label>
                                                <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">Search</label>
                                                <input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-email-input" class="form-label">Email</label>
                                                <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">URL</label>
                                                <input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-tel-input" class="form-label">Telephone</label>
                                                <input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-password-input" class="form-label">Password</label>
                                                <input class="form-control" type="password" value="hunter2" id="example-password-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-number-input" class="form-label">Number</label>
                                                <input class="form-control" type="number" value="42" id="example-number-input">
                                            </div>
                                            <div>
                                                <label for="example-datetime-local-input" class="form-label">Date and time</label>
                                                <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="example-datetime-local-input">
                                            </div>
                                            <div class="mt-4">
                                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3 mt-lg-0">
                                            <div class="mb-3">
                                                <label for="example-date-input" class="form-label">Date</label>
                                                <input class="form-control" type="date" value="2019-08-19" id="example-date-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-month-input" class="form-label">Month</label>
                                                <input class="form-control" type="month" value="2019-08" id="example-month-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-week-input" class="form-label">Week</label>
                                                <input class="form-control" type="week" value="2019-W33" id="example-week-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-time-input" class="form-label">Time</label>
                                                <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-color-input" class="form-label">Color picker</label>
                                                <input type="color" class="form-control form-control-color mw-100" id="example-color-input" value="#5156be" title="Choose your color">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Select</label>
                                                <select class="form-select">
                                                    <option>Select</option>
                                                    <option>Large select</option>
                                                    <option>Small select</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label for="exampleDataList" class="form-label">Datalists</label>
                                                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                                                <datalist id="datalistOptions">
                                                    <option value="San Francisco">
                                                    <option value="New York">
                                                    <option value="Seattle">
                                                    <option value="Los Angeles">
                                                    <option value="Chicago">
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div> 
        </div>

        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>

<script src="assets/js/app.js"></script>

</body>

</html>