jQuery(document).ready(function () {
    jQuery("#app").next().css({
        "display": "none"
    });
});
var app = new Vue({
    el: "#app",
    data: function () {
        return {
            step1: true,
            step2: false,
            step3: false,

            IssueOptionOther: false,

            nozipcode: false,

            baseUrl: wpvalues.baseurl,
            restPrefix: "/wp-json/repairmanagement/v1/orders/insert",

            zipcodes: ["11545", "11568", "11548", "11576", "11577", "11545", "11732", "11753", "11771", "11791", "11566", "11563", "11710", "11738", "11793", "11554", "11555", "11590", "11563", "11570", "11571"],

            zipcode: '',
            mmodel: '',
            color: '',
            issueOption: '',
            issueOptionText: '',
            address: '',
            date: '',
            time: '',
            userName: '',
            email: '',
            mobileBrand: '',
            status: 'Pending',
            userId: (wpvalues.userid != '') ? wpvalues.userid : '',


        };
    },
    watch: {
        issueOption: function (val) {
            if (val === 'Other') this.IssueOptionOther = true;
            else this.IssueOptionOther = false;
        }
    },
    methods: {
        CheckZipCode: function (ele) {
            ele.preventDefault();
            var vals = this.zipcodes.includes(this.zipcode);
            if (vals) {
                this.step1 = false;
                this.nozipcode = false;
            } else {
                this.nozipcode = true;
            }



        },
        SubmitOrder: function (ele) {
            ele.preventDefault();
            var form = new FormData();
            form.append("zipcode", this.zipcode);
            form.append("model", this.mmodel);
            form.append("color", this.color);
            form.append("issueType", this.issueOption);
            form.append("issueDescription", this.issueOptionText);
            form.append("address", this.address);
            form.append("date", this.date);
            form.append("time", this.time);
            form.append("userId", this.userId);
            form.append("userName", this.userName);
            form.append("email", this.email);
            form.append("mobileBrand", this.mobileBrand);
            form.append("status", this.status);


            axios.post(this.baseUrl + this.restPrefix, form).then((res => {
                if (res.data.status == true) {
                    if (confirm("Your Order Has Been Submitted! Order No: " + res.data.inserted_id)) {
                        location.replace(wpvalues.baseurl);
                    }

                }
            })).catch(err => {

            });
        },
        Proceed: function (ele) {
            ele.preventDefault();
            this.step2 = false;

        },

        // Transition Methods
        OneAfterLeave: function () {
            this.step2 = true;
        },
        TwoAfterLeave: function () {
            this.step3 = true;
        }
    },
});