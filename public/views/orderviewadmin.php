<div class="container-fluid pt-4">
    <div id="adminApp" class="hidden">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="" v-on:click="NavTotal" v-bind:class="{ active: nav.total }">Total Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" v-on:click="NavPending" v-bind:class="{ active: nav.pending }">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" v-on:click="NavCompleted"
                   v-bind:class="{ active: nav.completed }">Completed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" v-on:click="NavSingle" v-bind:class="{ active: nav.single }">Single</a>
            </li>
        </ul>
        <br>
        <!--TOTAL SECTION-->

        <div class="table-responsive" v-if="nav.total">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Order No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone Brand</th>
                    <th scope="col">Phone Model</th>
                    <th scope="col">Phone Color</th>
                    <th scope="col">Issue Type</th>
                    <th scope="col">Issue Description</th>
                    <th scope="col">Appintment Date (y-m-d h-m-s)</th>
                    <th scope="col">Zipcode</th>
                    <th scope="col">Status</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="item in totalSection.totalOrdersList" v-on:click="SingleItemClick(item)">
                    <th scope="row">{{item.repair_id}}</th>
                    <td>{{item.repair_user_name}}</td>
                    <td>{{item.repair_user_email}}</td>
                    <td>{{item.repiar_user_address}}</td>
                    <td>{{item.repair_mobile_brand}}</td>
                    <td>{{item.repair_mobile_model}}</td>
                    <td>{{item.repair_mobile_color}}</td>
                    <td>{{item.repair_issue_type}}</td>
                    <td>{{item.repair_issue_description}}</td>
                    <td>{{item.repair_mobile_order_created}}</td>
                    <td>{{item.repair_zipcode}}</td>
                    <td>{{item.repair_status}}</td>
                </tr>

                </tbody>
            </table>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="" v-on:click="DecreasePageNumberTotal">Previous</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="" v-on:click="(el)=>el.preventDefault()">{{totalSection.currentPageNumberTotal}}
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="" v-on:click="IncreasePageNumberTotal">Next</a>
                    </li>
                </ul>
            </nav>
            <h4>Total Pages <span class="badge badge-secondary">{{this.totalSection.totalRowsCountTotal}}</span></h4>
        </div>


        <!--     PENDING SECTION   -->
        <div class="table-responsive" v-if="nav.pending">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Order No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone Brand</th>
                    <th scope="col">Phone Model</th>
                    <th scope="col">Phone Color</th>
                    <th scope="col">Issue Type</th>
                    <th scope="col">Issue Description</th>
                    <th scope="col">Appintment Date (y-m-d h-m-s)</th>
                    <th scope="col">Zipcode</th>
                    <th scope="col">Status</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="item in pendingSection.pendingOrdersList" v-on:click="SingleItemClick(item)">
                    <th scope="row">{{item.repair_id}}</th>
                    <td>{{item.repair_user_name}}</td>
                    <td>{{item.repair_user_email}}</td>
                    <td>{{item.repiar_user_address}}</td>
                    <td>{{item.repair_mobile_brand}}</td>
                    <td>{{item.repair_mobile_model}}</td>
                    <td>{{item.repair_mobile_color}}</td>
                    <td>{{item.repair_issue_type}}</td>
                    <td>{{item.repair_issue_description}}</td>
                    <td>{{item.repair_mobile_order_created}}</td>
                    <td>{{item.repair_zipcode}}</td>
                    <td>{{item.repair_status}}</td>
                </tr>

                </tbody>
            </table>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="" v-on:click="DecreasePageNumberPending">Previous</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="" v-on:click="(el)=>el.preventDefault()">{{pendingSection.currentPageNoPending}}
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="" v-on:click="IncreasePageNumberPending">Next</a>
                    </li>
                </ul>
            </nav>
            <h4>Total Pages <span class="badge badge-secondary">{{this.pendingSection.totalRowsCountPending}}</span>
            </h4>
        </div>


        <!--    COMPLETED SECTION-->
        <div class="table-responsive" v-if="nav.completed">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Order No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone Brand</th>
                    <th scope="col">Phone Model</th>
                    <th scope="col">Phone Color</th>
                    <th scope="col">Issue Type</th>
                    <th scope="col">Issue Description</th>
                    <th scope="col">Appintment Date (y-m-d h-m-s)</th>
                    <th scope="col">Zipcode</th>
                    <th scope="col">Status</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="item in completedSection.completedOrdersList" v-on:click="SingleItemClick(item)">
                    <th scope="row">{{item.repair_id}}</th>
                    <td>{{item.repair_user_name}}</td>
                    <td>{{item.repair_user_email}}</td>
                    <td>{{item.repiar_user_address}}</td>
                    <td>{{item.repair_mobile_brand}}</td>
                    <td>{{item.repair_mobile_model}}</td>
                    <td>{{item.repair_mobile_color}}</td>
                    <td>{{item.repair_issue_type}}</td>
                    <td>{{item.repair_issue_description}}</td>
                    <td>{{item.repair_mobile_order_created}}</td>
                    <td>{{item.repair_zipcode}}</td>
                    <td>{{item.repair_status}}</td>
                </tr>

                </tbody>
            </table>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="" v-on:click="DecreasePageNumberCompleted">Previous</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="" v-on:click="(el)=>el.preventDefault()">{{completedSection.currentPageNoCompleted}}
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="" v-on:click="IncreasePageNumberCompleted">Next</a>
                    </li>
                </ul>
            </nav>
            <h4>Total Pages <span class="badge badge-secondary">{{this.completedSection.totalRowsCountCompleted}}</span>
            </h4>
        </div>

        <div v-if="nav.single" class=" row justify-content-md-center">
            <div class="col-md-8 col-xl-6 col-sm-12 col-lg-6">
                <form>
                    <div class="form-group">
                        <label for="repair-id">Order No</label>
                        <input type="text" class="form-control" name="rapair-id" id="repair-id"
                               v-model="singleSection.singleItem.order_no" readonly>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="zipcode">Zip Code</label>
                        <input type="text" class="form-control" name="zipcode" id="zipcode"
                               v-model="singleSection.singleItem.zipcode">
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="mobile-brand">Phone Brand</label>
                        <select class="form-control" id="mobile-brand" v-model="singleSection.singleItem.mobileCompany">
                            <option>Samsung</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="model">Phone Model</label>
                        <input type="text" name="mmodel" id="mmodel" class="form-control" placeholder=""
                               v-model="singleSection.singleItem.mobileModel">
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" name="color" id="color" class="form-control" placeholder=""
                               v-model="singleSection.singleItem.color">
                    </div>
                    <div class="form-group">
                        <label for="issue">Issue</label>
                        <select class="form-control" id="issue-option" v-model="singleSection.singleItem.issue">
                            <option>Sceen Breakdown</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="issue">Issue Description</label>
                        <textarea class="form-control" id="issue-text" rows="3"
                                  v-model="singleSection.singleItem.issueDescription"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="uname">Name</label>
                        <input type="text" class="form-control" name="uname" id="uname" placeholder=""
                               v-model="singleSection.singleItem.userName">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder=""
                               v-model="singleSection.singleItem.userEmail">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder=""
                               v-model="singleSection.singleItem.userAddress">
                    </div>
                    <div class="form-group">
                        <label for="address">Date</label>
                        <input type="date" class="form-control" name="date" id="date" v-model="singleSection.singleItem.date">
                    </div>
                    <div class="form-group">
                        <label for="address">Time</label>
                        <input type="time" class="form-control" name="time" id="time" v-model="singleSection.singleItem.time">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" v-model="singleSection.singleItem.status">
                            <option>Pending</option>
                            <option>Completed</option>
                        </select>
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary" v-on:click="UpdateSingleItem">Update</button>
                    <small id="emailHelp" class="form-text text-muted" v-if="singleSection.updated">
                        The Status Has Been Updated
                    </small>
                    <small id="emailHelp" class="form-text text-danger" v-if="singleSection.notupdated">
                        ERROR!
                    </small>
                </form>
            </div>

        </div>


        <!--        EDIT RECORD-->
    </div>
</div>


