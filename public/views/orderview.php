<div id="app">
    <transition name="fade" v-on:after-leave="OneAfterLeave">
        <div id="step-1" v-if="step1">
            <form>
                <div class="form-group">
                    <label for="zipcode">Zip Code</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="zipcode" id="zipcode"
                               v-model="zipcode">
                        <br>
                        <small id="emailHelp" class="form-text text-muted" v-if="nozipcode">Sorry we dont operate in
                            your area for now.
                        </small>
                        <br>
                        <button type="submit" class="btn btn-primary mb-2"
                                v-on:click="CheckZipCode">Confirm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </transition>
    <form>
        <transition name="slide-fade" v-on:after-leave="TwoAfterLeave">
            <div id="step-2" v-if="step2">

                <div class="form-group">
                    <label for="mobile-brand">Mobile Company</label>
                    <select class="form-control" id="mobile-brand" v-model="mobileBrand">
                        <option>Samsung</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="model">Mobile Model</label>
                    <input type="text" name="mmodel" id="mmodel" class="form-control" placeholder=""
                           v-model="mmodel">
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" name="color" id="color" class="form-control" placeholder=""
                           v-model="color">
                </div>
                <div class="form-group">
                    <label for="issue">Issue</label>
                    <select class="form-control" id="issue-option" v-model="issueOption">
                        <option>Sceen Breakdown</option>
                        <option>Other</option>
                    </select>
                    <br>
                    <transition name="fade">
                                        <textarea class="form-control" id="issue-text" rows="3"
                                                  v-model="issueOptionText" v-if="IssueOptionOther"></textarea>
                    </transition>
                    <br>

                    <button type="submit" class="btn btn-primary mb-2"
                            v-on:click="Proceed">Proceed
                    </button>
                </div>
            </div>
        </transition>
        <transition name="slide-fade" v-on:after-leave="TwoAfterLeave">
            <div id="step-3" v-if="step3">

                <div class="form-group">
                    <label for="uname">Name</label>
                    <input type="text" class="form-control" name="uname" id="uname" placeholder=""
                           v-model="userName">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder=""
                           v-model="email">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder=""
                           v-model="address">
                </div>
                <div class="form-group">
                    <label for="address">Date</label>
                    <input type="date" class="form-control" name="date" id="date" v-model="date">
                </div>
                <div class="form-group">
                    <label for="address">Time</label>
                    <input type="time" class="form-control" name="time" id="time" v-model="time">
                </div>
                <br>
                <button type="submit" class="btn btn-primary mb-2" v-on:click="SubmitOrder">Submit
                    Order
                </button>

            </div>
        </transition>
    </form>
</div>