angular.module('project',[]).controller('Vote', function ($scope) {
	
	$scope.options = [];
	$scope.option = {};
	$scope.hide = {};
	$scope.title = '';
	$scope.validOptions = 1;
	$scope.start = false;
	$scope.blanco = 0;
	$scope.invalid = 0;
	$scope.threshold = 0;

	$scope.history = [];

	/** Options management */
	$scope.saveOption = function () {
		$scope.options.push({
			name : $scope.option.name,
			count : 0
		});
		$scope.option = {};
	};
	$scope.resetCount = function () {
		angular.forEach($scope.options, function (o) {
			o.count = 0;
		});
		$scope.blanco = 0;
		$scope.invalid = 0;
		$scope.threshold = 0;
	};
	$scope.removeOption = function (opt) {
		$scope.options = _.filter($scope.options, function (a) {
			return a != opt;
		});
	};

	/* Vote */
	$scope.vote = function (opt) {
		opt.count++;
		$scope.history.push({
			type : 'vote',
			obj : opt
		});
	};
	
	$scope.revert = function () {
		var last = $scope.history.pop();
		
		if(last == null || last === undefined) {
			return;
		}
		
		if(last.type == 'vote') {
			last.obj.count--;
		} else if(last.type == 'blanco') {
			$scope.blanco--;
		} else if(last.type == 'invalid') {
			$scope.invalid--;
		}
	};
	
	$scope.addBlanco = function () {
		$scope.blanco++;
		
		$scope.history.push({
			type : 'blanco'
		});
	};

	$scope.addInvalid = function () {
		$scope.invalid++;

		$scope.history.push({
			type : 'invalid'
		});
	};

	$scope.wh = function (opt) {
	
		var height = 0;
		var tot = 0;
		var max = 0;
		angular.forEach($scope.options, function (a) {
			tot += a.count;
			
			if(a.count > max) 
				max = a.count;
		});
        $scope.threshold = Math.ceil((tot + 1) / (2 * $scope.validOptions));

        if($scope.threshold > max)
            max = $scope.threshold;

		height = (opt.count / (max)) * 400;
	
		return {
			width : (90 / $scope.options.length) + '%',
			height: 60 + height + 'px',
			left: (5 + $scope.options.indexOf(opt) * (90 / $scope.options.length)) + '%'

		};
	
	};
	
	$scope.voteDiv = function () {

		var height = 0;
		var tot = 0;
		var max = 0;
		angular.forEach($scope.options, function (a) {
			tot += a.count;

			if(a.count > max)
				max = a.count;
		});

		$scope.threshold = Math.ceil((tot + 1) / (2 * $scope.validOptions));

        if($scope.threshold > max)
            max = $scope.threshold;

		return {
			bottom : 60 + (($scope.threshold / (max)) * 400) + 'px'
		};
	};

});