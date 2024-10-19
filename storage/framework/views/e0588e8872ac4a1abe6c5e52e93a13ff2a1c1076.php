<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Lead')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Lead Report')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#general-report" class="list-group-item list-group-item-action border-0"><?php echo e(__('General Report')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#staff-report" class="list-group-item list-group-item-action border-0"><?php echo e(__('Staff Report')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#pipeline-report" class="list-group-item list-group-item-action border-0"><?php echo e(__('Pipelines Report')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    <div id="general-report">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('This Week Leads Conversions')); ?></h5>
                            </div>
                            <div class="card-body pt-0 ">
                                <div id="leads-this-week"
                                     data-color="primary" data-height="280">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Sources Conversion')); ?></h5>
                            </div>
                            <div class="card-body pt-0">
                                <div class="leads-sources-report" id="leads-sources-report"
                                     data-color="primary" data-height="280">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-9">
                                        <h5><?php echo e(__('Monthly')); ?></h5>
                                    </div>
                                    <div class="col-3 float-right">
                                        <select name="month" class="form-control selectpicker" id="selectmonth" data-none-selected-text="Nothing selected" >
                                            <option value=" "><?php echo e(__('Select Month')); ?></option>
                                            <option value="1"><?php echo e(__('January')); ?></option>
                                            <option value="2"><?php echo e(__('February')); ?></option>
                                            <option value="3"><?php echo e(__('March')); ?></option>
                                            <option value="4"><?php echo e(__('April')); ?></option>
                                            <option value="5"><?php echo e(__('May')); ?></option>
                                            <option value="6"><?php echo e(__('June')); ?></option>
                                            <option value="7"><?php echo e(__('July')); ?></option>
                                            <option value="8"><?php echo e(__('August')); ?></option>
                                            <option value="9"><?php echo e(__('September')); ?></option>
                                            <option value="10"><?php echo e(__('October')); ?></option>
                                            <option value="11"><?php echo e(__('November')); ?></option>
                                            <option value="12"><?php echo e(__('December')); ?></option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="card-body">

                                <div class="mt-3">
                                    <div id="leads-monthly" data-color="primary" data-height="280"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="staff-report" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Staff Report')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php echo e(Form::label('From Date', __('From Date'),['class'=>'col-form-label'])); ?>

                                    <?php echo e(Form::date('From Date',null, array('class' => 'form-control from_date','id'=>'data_picker1',))); ?>

                                    <span id="fromDate" style="color: red;"></span>
                                </div>
                                <div class="col-md-4">
                                    <?php echo e(Form::label('To Date', __('To Date'),['class'=>'col-form-label'])); ?>

                                    <?php echo e(Form::date('To Date',null, array('class' => 'form-control to_date','id'=>'data_picker2',))); ?>

                                    <span id="toDate"  style="color: red;"></span>
                                </div>
                                <div class="col-md-4" id="filter_type" style="padding-top : 38px;">
                                    <button  class="btn btn-primary label-margin generate_button" ><?php echo e(__('Generate')); ?></button>
                                </div>
                            </div>
                            <div id="leads-staff-report" class="mt-3"
                                 data-color="primary" data-height="280">
                            </div>
                        </div>
                    </div>
                    <div id="pipeline-report" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Pipeline Report')); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div id="leads-piplines-report"
                                     data-color="primary" data-height="280"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>

    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        $(".list-group-item").click(function(){
            $('.list-group-item').filter(function(){
                return this.href == id;
            }).parent().removeClass('text-primary');
        });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
    </script>

    <script>

        $(".generate_button").click(function(){
            var from_date = $('.from_date').val();
            if(from_date == ''){
                $("#fromDate").text("Please select date");
            }else{
                $("#fromDate").empty();
            }
            var to_date = $('.to_date').val();
            if(to_date == ''){
                $("#toDate").text("Please select date");
            }else{
                $("#toDate").empty();
            }
            $.ajax({
                url: "<?php echo e(route('report.lead')); ?>",
                type: "get",
                data: {
                    "From_Date": from_date,
                    "To_Date": to_date,
                    "type": 'staff_repport',
                    "_token": "<?php echo e(csrf_token()); ?>",
                },

                cache: false,
                success: function(data) {

                    $("#leads-staff-report").empty();
                    var chartBarOptions = {
                        series: [{
                            name: 'Lead',
                            data: data.data,
                        }],

                        chart: {
                            height: 300,
                            type: 'bar',
                            dropShadow: {
                                enabled: true,
                                color: '#000',
                                top: 18,
                                left: 7,
                                blur: 10,
                                opacity: 0.2
                            },
                            toolbar: {
                                show: false
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: 2,
                            curve: 'smooth'
                        },
                        title: {
                            text: '',
                            align: 'left'
                        },
                        xaxis: {
                            categories: data.name,


                        },
                        colors: ['#6fd944', '#6fd944'],


                        grid: {
                            strokeDashArray: 4,
                        },
                        legend: {
                            show: false,
                        }

                    };
                    var arChart = new ApexCharts(document.querySelector("#leads-staff-report"), chartBarOptions);
                    arChart.render();

                }
            })


        });


        $(document).ready(function(){
            $("#selectmonth").change(function(){
                var selectedVal = $("#selectmonth option:selected").val();
                var start_month = $('.selectpicker').val();
                $.ajax({
                    url:  "<?php echo e(route('report.lead')); ?>",
                    type: "get",
                    data:{
                        "start_month": start_month,
                        "_token": "<?php echo e(csrf_token()); ?>",
                    },
                    cache: false,
                    success: function(data){

                        $("#leads-monthly").empty();
                        var chartBarOptions = {
                            series: [{
                                name: 'Lead',
                                data: data.data,
                            }],

                            chart: {
                                height: 300,
                                type: 'bar',
                                dropShadow: {
                                    enabled: true,
                                    color: '#000',
                                    top: 18,
                                    left: 7,
                                    blur: 10,
                                    opacity: 0.2
                                },
                                toolbar: {
                                    show: false
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                width: 2,
                                curve: 'smooth'
                            },
                            title: {
                                text: '',
                                align: 'left'
                            },
                            xaxis: {
                                categories:data.name,

                                title: {
                                    text: '<?php echo e(__("Lead Per Month")); ?>'
                                }
                            },
                            colors: ['#6fd944', '#6fd944'],


                            grid: {
                                strokeDashArray: 4,
                            },
                            legend: {
                                show: false,
                            }

                        };
                        var arChart = new ApexCharts(document.querySelector("#leads-monthly"), chartBarOptions);
                        arChart.render();


                    }
                })
            });
        });


        $(document).on('click', '.lang-tab .nav-link', function() {
            $('.lang-tab .nav-link').removeClass('active');
            $('.tab-pane').removeClass('active');
            $(this).addClass('active');
            var id = $('.lang-tab .nav-link.active').attr('data-href');
            $(id).addClass('active');
        });
    </script>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
    <script>
        var options = {
            series: <?php echo json_encode($devicearray['data']); ?>,
            chart: {
                width: 350,
                type: 'pie',
            },

            colors: ["#35abb6","#ffa21d","#ff3a6e","#6fd943","#5c636a","#181e28","#0288d1"],
            labels: <?php echo json_encode($devicearray['label']); ?>,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom',
                    }
                }
            }]
        };
        var chart = new ApexCharts(document.querySelector("#leads-this-week"), options);
        chart.render();

        (function () {
            var chartBarOptions = {
                series: [{
                    name: 'Source',
                    data: <?php echo json_encode($leadsourceeData); ?>,
                }],

                chart: {
                    height: 300,
                    type: 'bar',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: <?php echo json_encode($leadsourceName); ?>,

                    title: {
                        text: '<?php echo e(__("Source")); ?>'
                    }
                },
                colors: ['#ffa21d', '#ffa21d'],


                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                }

            };
            var arChart = new ApexCharts(document.querySelector("#leads-sources-report"), chartBarOptions);
            arChart.render();
        })();

        (function () {
            var chartBarOptions = {
                series: [{
                    name: 'Lead',
                    data: <?php echo json_encode($data); ?>,
                }],

                chart: {
                    height: 300,
                    type: 'bar',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: <?php echo json_encode($labels); ?>,

                    title: {
                        text: '<?php echo e(__("Lead Per Month")); ?>'
                    }
                },
                colors: ['#6fd944', '#6fd944'],


                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                }

            };
            var arChart = new ApexCharts(document.querySelector("#leads-monthly"), chartBarOptions);
            arChart.render();
        })();

        (function () {
            var chartBarOptions = {
                series: [{
                    name: 'Lead',
                    data: <?php echo json_encode($leadusereData); ?>,
                }],

                chart: {
                    height: 300,
                    type: 'bar',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: <?php echo json_encode($leaduserName); ?>,
                    title: {
                        text: '<?php echo e(__("User")); ?>'
                    }
                },
                colors: ['#6fd944', '#6fd944'],


                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                }

            };
            var arChart = new ApexCharts(document.querySelector("#leads-staff-report"), chartBarOptions);
            arChart.render();
        })();

        (function () {
            var chartBarOptions = {
                series: [{
                    name: 'Pipeline',
                    data: <?php echo json_encode($leadpipelineeData); ?>,
                }],

                chart: {
                    height: 300,
                    type: 'bar',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                xaxis: {
                    categories: <?php echo json_encode($leadpipelineName); ?>,

                    title: {
                        text: '<?php echo e(__("Pipelines")); ?>'
                    }
                },
                yaxis: {
                    title: {
                        text: '<?php echo e(__("Leads")); ?>'
                    }
                },
                colors: ['#6fd944', '#6fd944'],


                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                }

            };
            var arChart = new ApexCharts(document.querySelector("#leads-piplines-report"), chartBarOptions);
            arChart.render();
        })();

    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\~Prgoramming\Projects\Laravel\Mini Projects\erpgo\resources\views/report/lead.blade.php ENDPATH**/ ?>