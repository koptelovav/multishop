<?php
$this->panelTitle = 'Динамика закаков';
$this->Widget('backend.extensions.highcharts.HighchartsWidget', array(
    'options' => "{
            chart: {
                type: 'spline'
            },

            title: {
                text: ''
            },

            xAxis: {
                type: 'datetime'
            },

            yAxis: {
                title: {
                    text: 'Количество заказов'
                },
                min: 0,
            },

            plotOptions: {
                spline: {
                    lineWidth: 4,
                    states: {
                        hover: {
                            lineWidth: 5
                        }
                    },
                    marker: {
                        enabled: false
                    },

                    }
                },
                series: [{
                    name: 'Количество заказов',
                     pointInterval: 604800000,
                     pointStart: ".$startDate.",
                    data: ".$data."
                }],
                navigation: {
                    menuItemStyle: {
                        fontSize: '10px'
                    }
                }
            }
        );
    }"
));

$this->Widget('backend.extensions.highcharts.HighchartsWidget', array(
    'options' => "{
            chart: {
                type: 'spline'
            },

            title: {
                text: ''
            },

            xAxis: {
                type: 'datetime'
            },

            yAxis: {
                title: {
                    text: 'Оборот'
                },
                min: 0,
            },

            plotOptions: {
                spline: {
                    lineWidth: 4,
                    states: {
                        hover: {
                            lineWidth: 5
                        }
                    },
                    marker: {
                        enabled: false
                    },

                    }
                },
                series: [{
                    name: 'Сумма заказов',
                     pointInterval: 604800000,
                     pointStart: ".$startDate.",
                    data: ".$dataSum."
                }],
                navigation: {
                    menuItemStyle: {
                        fontSize: '10px'
                    }
                }
            }
        );
    }"
));