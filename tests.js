describe("Controller: LoginController",function() {
	beforeEach(function() {
		module("app");
	});
	beforeEach(inject(function($controller,$rootScope,$location,ApiService){
		this.location = $location;
		this.scope = $rootScope.new();
		this.redirect = spyOn($location,'path');
		$controller('LoginController',{
			$scope: $rootScope,
			$location:$location
		});
	}));

	describe("successfully log in",function() {
		it("should redirect you to /news",function() {
			this.scope.credentials.username = "admin";
			this.scope.login();
			expect(this.redirect).toHaveBeenCalledWith("/news");
		});
		it("should not redirect",function() {
			this.scope.credentials.username = "asdf";
			this.scope.login();
			expect(this.redirect).notToHaveBeenCalled();
		});
	});
});