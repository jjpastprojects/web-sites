"use strict";
/*globals moment */


describe("Localise the game start date, UTC", function () {

    it("should handle strings correctly", function () {
        var date = "2014-03-21 23:00:00";

        expect(moment.utc(date).format()).toBe("2014-03-21T23:00:00+00:00");

    });


});