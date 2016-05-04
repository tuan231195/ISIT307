<div ng-controller="loginValidation" class="modal" id="loginModal"
	role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method = "POST" action = "?c=authorize&a=login&curPage=<?php echo isset($_GET['a'])? $_GET['a']: 'index' ?>" name="loginForm" id="loginform" class="form-horizontal"
				role="form">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<h4 id="myModalLabel">Please log in:</h4>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<span class="input-group-addon"><i
							class="glyphicon glyphicon-user"></i></span> <input type="text"
							id="id" type="text" class="form-control" name="id" value=""
							placeholder="Student Id" required ng-model="id" />
					</div>
					<div class="error" ng-show="loginForm.id.$dirty">
						<span ng-show="loginForm.id.$error.required">Student Id is required</span> <span
							ng-show="!loginForm.id.$error.required && invalidId()">Student id must be a sequence of 7 digits</span>
					</div>
					<div style="margin-bottom: 25px"></div>
					<div class="input-group">
						<span class="input-group-addon"><i
							class="glyphicon glyphicon-lock"></i></span> <input id="login-password"
							type="password" class="form-control" name="password"
							placeholder="password" ng-model="password" />
						<div class='clearfix'></div>

					</div>
					<?php if (isset($_GET["error"])){
                        ?>
                        <div class="error" ng-show="!loginForm.password.$dirty">
                            Password and username do not match
                        </div>
                    <?php
                    }
                    ?>
					<div class="error" ng-show="loginForm.password.$dirty">
						<span ng-show="loginForm.password.$error.required">Password
							field is required</span> <span
							ng-show="!loginForm.password.$error.required && invalidPass()">Password
							must be greated than 8 characters</span>
					</div>
					<div style="margin-bottom: 25px"></div>


					<div style="margin-top: 10px" class="form-group">
						<!-- Button -->

						<div class="col-sm-12 controls">
							<button type = "submit" id="btn-login"  class="btn btn-success"
								ng-disabled="invalidId() || invalidPass()">Login</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
