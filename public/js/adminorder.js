jQuery(document).ready(function () {
    jQuery("#adminApp").removeClass("hidden")
});

var adminApp = new Vue({
    el: '#adminApp',
    data: function () {
        return {
            totalSection: {
                totalOrdersList: [],
                currentPageNumberTotal: 1,
                totalRowsCountTotal: 0,
            },
            pendingSection: {
                pendingOrdersList: [],
                currentPageNoPending: 1,
                totalRowsCountPending: 0,
            },
            completedSection: {
                completedOrdersList: [],
                currentPageNoCompleted: 1,
                totalRowsCountCompleted: 0,

            },
            singleSection: {
                singleItem: {
                    order_no: '',
                    zipcode: '',
                    mobileCompany: '',
                    mobileModel: '',
                    color: '',
                    issue: '',
                    issueDescription: '',
                    userName: '',
                    userEmail: '',
                    userAddress: '',
                    date: '',
                    time: '',
                    status: ''
                },
                updated: false,
                notupdated: false
            },

            nav: {
                total: true,
                pending: false,
                completed: false,
                single: false
            }
        };
    },
    methods: {
        //TOTAL SECTION--------------------------------------------------------------
        PullTotalOrders: function (val) {
            let that = this;
            let url = wpvalues.baseurl + "/wp-json/repairmanagement/v1/orders/get/total";
            axios.get(url + "?page=" + (this.totalSection.currentPageNumberTotal - 1).toString() + "&userid=" + wpvalues.userId.toString()).then(function (res) {

                that.totalSection.totalOrdersList = res.data.data;

            }).catch(function (err) {

            });
        },
        PullTotalOrdersCount: function () {
            let that = this;
            let url = wpvalues.baseurl + "/wp-json/repairmanagement/v1/orders/get/total";
            axios.get(url + "?count=1" + "&userid=" + wpvalues.userId.toString()).then(function (res) {

                that.totalSection.totalRowsCountTotal = Math.ceil(parseInt(res.data.data[0]["COUNT(*)"]) / 50);

            }).catch(function (err) {

            });
        },
        IncreasePageNumberTotal: function (el) {
            el.preventDefault();
            if (this.totalSection.currentPageNumberTotal == this.totalSection.totalRowsCountTotal) {
                return;
            }
            this.totalSection.currentPageNumberTotal += 1;
        },
        DecreasePageNumberTotal: function (el) {
            el.preventDefault();
            if (this.totalSection.currentPageNumberTotal < 2) {
                return;
            }
            this.totalSection.currentPageNumberTotal -= 1;
        },

        //    PENDING SECTION----------------------------------------------------------------
        PullPendingOrders: function (val) {
            let that = this;
            let url = wpvalues.baseurl + "/wp-json/repairmanagement/v1/orders/get/pending";
            axios.get(url + "?page=" + (this.pendingSection.currentPageNoPending - 1).toString() + "&userid=" + wpvalues.userId.toString()).then(function (res) {

                that.pendingSection.pendingOrdersList = res.data.data;

            }).catch(function (err) {

            });
        },
        PullPendingOrdersCount: function () {
            let that = this;
            let url = wpvalues.baseurl + "/wp-json/repairmanagement/v1/orders/get/pending";
            axios.get(url + "?count=1" + "&userid=" + wpvalues.userId.toString()).then(function (res) {

                that.pendingSection.totalRowsCountPending = Math.ceil(parseInt(res.data.data[0]["COUNT(*)"]) / 50);

            }).catch(function (err) {

            });
        },
        IncreasePageNumberPending: function (el) {
            el.preventDefault();
            if (this.pendingSection.currentPageNoPending == this.pendingSection.totalRowsCountPending) {
                return;
            }
            this.pendingSection.currentPageNoPending += 1;
        },
        DecreasePageNumberPending: function (el) {
            el.preventDefault();
            if (this.pendingSection.currentPageNoPending < 2) {
                return;
            }
            this.pendingSection.currentPageNoPending -= 1;
        },


        //    COMPLETED SECTION--------------------------------------------------------
        PullCompletedOrders: function (val) {
            let that = this;
            let url = wpvalues.baseurl + "/wp-json/repairmanagement/v1/orders/get/completed";
            axios.get(url + "?page=" + (this.completedSection.currentPageNoCompleted - 1).toString() + "&userid=" + wpvalues.userId.toString()).then(function (res) {

                that.completedSection.completedOrdersList = res.data.data;

            }).catch(function (err) {

            });
        },
        PullCompletedOrdersCount: function () {
            let that = this;
            let url = wpvalues.baseurl + "/wp-json/repairmanagement/v1/orders/get/completed";
            axios.get(url + "?count=1" + "&userid=" + wpvalues.userId.toString()).then(function (res) {

                that.completedSection.totalRowsCountCompleted = Math.ceil(parseInt(res.data.data[0]["COUNT(*)"]) / 50);

            }).catch(function (err) {

            });
        },
        IncreasePageNumberCompleted: function (el) {
            el.preventDefault();
            if (this.completedSection.currentPageNoCompleted == this.completedSection.totalRowsCountCompleted) {
                return;
            }
            this.completedSection.currentPageNoCompleted += 1;
        },
        DecreasePageNumberCompleted: function (el) {
            el.preventDefault();
            if (this.completedSection.currentPageNoCompleted < 2) {
                return;
            }
            this.completedSection.currentPageNoCompleted -= 1;
        },

        //    SINGLE SECTION
        AllVisibilityOff: function () {
            this.nav.total = false;
            this.nav.completed = false;
            this.nav.pending = false;
            this.nav.single = false;
        },
        SingleItemClick: function (item) {
            this.AllVisibilityOff();
            this.singleSection.singleItem.order_no = item.repair_id;
            this.singleSection.singleItem.userName = item.repair_user_name;
            this.singleSection.singleItem.userEmail = item.repair_user_email;
            this.singleSection.singleItem.userAddress = item.repiar_user_address;
            this.singleSection.singleItem.mobileCompany = item.repair_mobile_brand;
            this.singleSection.singleItem.mobileModel = item.repair_mobile_model;
            this.singleSection.singleItem.color = item.repair_mobile_color;
            this.singleSection.singleItem.issue = item.repair_issue_type;
            this.singleSection.singleItem.issueDescription = item.repair_issue_description;
            this.singleSection.singleItem.zipcode = item.repair_zipcode;
            this.singleSection.singleItem.status = item.repair_status;
            var arr = item.repair_mobile_order_created.split(" ");
            this.singleSection.singleItem.date = arr[0];
            this.singleSection.singleItem.time = arr[1];
            this.nav.single = true;

        },
        ClearSingleSection: function () {
            this.singleSection.singleItem.order_no = '';
            this.singleSection.singleItem.userName = '';
            this.singleSection.singleItem.userEmail = '';
            this.singleSection.singleItem.userAddress = '';
            this.singleSection.singleItem.mobileCompany = '';
            this.singleSection.singleItem.mobileModel = '';
            this.singleSection.singleItem.color = '';
            this.singleSection.singleItem.issue = '';
            this.singleSection.singleItem.issueDescription = '';
            this.singleSection.singleItem.zipcode = '';
            this.singleSection.singleItem.status = '';
            this.singleSection.singleItem.date = '';
            this.singleSection.singleItem.time = '';
            this.singleSection.updated = false;
            this.singleSection.notupdated = false;
        },
        UpdateSingleItem: function (el) {
            el.preventDefault();
            let that = this;
            let url = wpvalues.baseurl + "/wp-json/repairmanagement/v1/orders/update/single";
            axios.get(url + "?orderno=" + that.singleSection.singleItem.order_no.toString() + "&status=" + that.singleSection.singleItem.status + "&userid=" + wpvalues.userId.toString()).then(function (res) {

                if (res.data.status == true) {
                    that.singleSection.updated = true;

                } else {
                    that.singleSection.notupdated = true;
                }
            }).catch(function (err) {

            });
        },

        //    NAV FUNCTIONS
        NavTotal: function (el) {
            el.preventDefault();

            this.PullTotalOrdersCount();
            this.PullTotalOrders(this.totalSection.currentPageNumberTotal);
            this.ClearSingleSection();
            this.nav.pending = false;
            this.nav.completed = false;
            this.nav.single = false;
            this.nav.total = true;
        },
        NavPending: function (el) {
            el.preventDefault();

            this.PullPendingOrdersCount();
            this.PullPendingOrders(this.pendingSection.currentPageNoPending);
            this.ClearSingleSection();
            this.nav.completed = false;
            this.nav.total = false;
            this.nav.single = false;
            this.nav.pending = true;

        },
        NavCompleted: function (el) {
            el.preventDefault();

            this.PullCompletedOrdersCount();
            this.PullCompletedOrders(this.completedSection.currentPageNoCompleted);
            this.ClearSingleSection();
            this.nav.pending = false;
            this.nav.total = false;
            this.nav.single = false;
            this.nav.completed = true;
        },
        NavSingle: function (el) {
            el.preventDefault();
            this.nav.pending = false;
            this.nav.total = false;
            this.nav.completed = false;
            this.nav.single = true;
        }
    },
    watch: {
        'totalSection.currentPageNumberTotal': function (val) {

            this.PullTotalOrders(val);
        },
        'pendingSection.currentPageNoPending': function (val) {
            this.PullPendingOrders(val);
        },
        'completedSection.currentPageNoCompleted': function (val) {
            this.PullCompletedOrders(val);
        }
    },
    created() {
        this.PullTotalOrdersCount();
        this.PullTotalOrders(this.totalSection.currentPageNumberTotal);

    }
});