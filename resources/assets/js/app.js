;(function (window, document, $, undefined) {
	'use strict';

	var multimediatipset = {
		init: function () {
			$('ol.sortable').sortable();
			if (document.getElementById('create-game')) {
				var createGame = new Vue({
					el: '#create-game',
					data: {
						teams: [],
						matches: [],
						newTeam: ''
					},
					methods: {
						changeGameType: function (e) {
							this.gameType = e.currentTarget.value;
						},
						addTeam: function (event) {
							event.preventDefault();
							this.teams.push(this.newTeam);
							this.newTeam = '';
						},
						removeTeam: function (teamIndex, event) {
							event.preventDefault();
							this.teams.splice(teamIndex, 1);
						}
					}
				});
			}

		}
	};

	$(document).ready(function () {
		multimediatipset.init();
	});

})(window, document, jQuery);