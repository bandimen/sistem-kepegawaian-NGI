<!doctype html>
<html lang="en">

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>
    <style>
        .tab-button {
            cursor: pointer;
            padding: 10px 20px;
            border: none;
            background: none;
            font-weight: bold;
            color: #6c757d;
        }

        .tab-button.active {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }
    </style>
</head>

<?= $this->include('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">
    <?= $this->include('partials/menu') ?>

    <!-- Start right Content here -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- Start page title -->
                <?= $page_title ?>
                <!-- End page title -->

                <!-- Tabs Navigation -->
                <div class="d-flex mb-4">
                    <button class="tab-button active" data-tab="data-tab">Data</button>
                    <button class="tab-button" data-tab="update-tab">Update</button>
                </div>

                <!-- Tabs Content -->
                <div>
                    <!-- Data Tab -->
                    <!-- Data Tab -->
                    <div id="data-tab" class="tab-content active">
                        <h4>Data</h4>
                        <p>Berikut adalah data yang tersedia:</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Jenis User</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>John Doe</td>
                                    <td>628123456789</td>
                                    <td>johndoe@example.com</td>
                                    <td>Admin</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jane Smith</td>
                                    <td>628987654321</td>
                                    <td>janesmith@example.com</td>
                                    <td>Operator</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Update Tab -->
                    <div id="update-tab" class="tab-content">
                        <h4>Update</h4>
                        <p>Isi form untuk update data di sini:</p>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Textual inputs</h4>
                                <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each
                                    textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-lg-6">
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

                                    <div class="col-lg-6">
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
                </div>
            </div>
        </div>
        <?= $this->include('partials/footer') ?>
    </div>
</div>

<!-- JavaScript untuk Navigasi Tab -->
<script>
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Reset all active states
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Activate the clicked tab and corresponding content
            button.classList.add('active');
            document.getElementById(button.dataset.tab).classList.add('active');
        });
    });
</script>

</body>

</html>