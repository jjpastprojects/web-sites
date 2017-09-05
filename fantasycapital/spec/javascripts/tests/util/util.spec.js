"use strict";
/*globals describe, it */

describe("util.validate.password - utility module tests", function () {
    it("password - one number is necessary", function () {
        expect(util.validate.password("hello")).toBe(false);
        expect(util.validate.password("world")).toBe(false);
        expect(util.validate.password("superstar")).toBe(false);
        expect(util.validate.password("w0rld")).toBe(true);
        expect(util.validate.password("h3ll0")).toBe(true);
        expect(util.validate.password("p4sww0rd99")).toBe(true);
        expect(util.validate.password("T3st@2000")).toBe(true);
        expect(util.validate.password("alice1")).toBe(true);
        // additional module could be added to prompt to user if his
        // password is easy to guess
        expect(util.validate.password("qwerty1234")).toBe(true);
        expect(util.validate.password("qwerty1")).toBe(true);
        expect(util.validate.password("asdf1234")).toBe(true);
    });
    it("password - 5 to 15 characters", function () {
        expect(util.validate.password("a")).toBe(false);
        expect(util.validate.password("ab")).toBe(false);
        expect(util.validate.password("abc")).toBe(false);
        expect(util.validate.password("abcd")).toBe(false);
        expect(util.validate.password("abc1a")).toBe(true);
        expect(util.validate.password("abcdeabc2e")).toBe(true);
        expect(util.validate.password("abcdeabcdeab3df")).toBe(true);
        expect(util.validate.password("abcdeabcdeabcdex")).toBe(false);
    });
    it("password - can contain special characters !@#$%^&*", function () {
        expect(util.validate.password("_")).toBe(false);
        expect(util.validate.password("a$")).toBe(false);
        expect(util.validate.password("@bc")).toBe(false);
        expect(util.validate.password("a!cd")).toBe(false);
        expect(util.validate.password("!@#$%^&*1")).toBe(true);
        expect(util.validate.password("_____")).toBe(false);
        expect(util.validate.password("-------")).toBe(false);
        expect(util.validate.password("abcd^&*c1")).toBe(true);
    });
    it("password - has to be at least 5 letters long", function () {
        expect(util.validate.password("abc1")).toBe(false);
        expect(util.validate.password("abew")).toBe(false);
        expect(util.validate.password("1234")).toBe(false);
        expect(util.validate.password("q2w1")).toBe(false);
        expect(util.validate.password("t12@")).toBe(false);
        expect(util.validate.password("@%1x")).toBe(false);
        expect(util.validate.password("@312")).toBe(false);
        expect(util.validate.password("a111")).toBe(false);
        expect(util.validate.password("aaxc")).toBe(false);
    });
    it("password - has to be lte than 15 letters long", function () {
        expect(util.validate.password("abc1eaetqbcqe1eabc1eX")).toBe(false);
        expect(util.validate.password("qwe1eaetqbbc1eabc1ea")).toBe(false);
        expect(util.validate.password("xyz1eateq521Yabc1e1")).toBe(false);
        expect(util.validate.password("www1eetqabc1eabY1e4")).toBe(false);
        expect(util.validate.password("QAc111bc1eabcQe@")).toBe(false);
        expect(util.validate.password("aBc1eabcetqqt1eabc1e5")).toBe(false);
        expect(util.validate.password("abc1eqetabc1eabcWe1")).toBe(false);
        expect(util.validate.password("aqwqweretyqBBeabc1e2")).toBe(false);
        expect(util.validate.password("abx1eAXa1eqteabc1e7")).toBe(false);
    });
    it("password - standard passwords should be accepted", function () {
        expect(util.validate.password("abc1e@@et")).toBe(true);
        expect(util.validate.password("QxTc1Y##$")).toBe(true);
        expect(util.validate.password("xzc1$$2")).toBe(true);
        expect(util.validate.password("tjR22^%")).toBe(true);
        expect(util.validate.password("njh*e%%&2")).toBe(true);
        expect(util.validate.password("kljil@98et")).toBe(true);
        expect(util.validate.password("nyt1e785!et")).toBe(true);
        expect(util.validate.password("yrwbc221%")).toBe(true);
    });
});

describe("util.validate.email - utility module tests", function () {
    it("email - should accept standard e-mails", function () {
        expect(util.validate.email("lime@strawberry.com")).toBe(true);
        expect(util.validate.email("bob@gmail.com")).toBe(true);
        expect(util.validate.email("henry@yahoo.com")).toBe(true);
        expect(util.validate.email("alice100@o2.pl")).toBe(true);
        expect(util.validate.email("john@museum.com")).toBe(true);
        expect(util.validate.email("sarah@mckenzie.com")).toBe(true);
    });
    it("email - should return false for broken addresses", function () {
        expect(util.validate.email("lime@.com")).toBe(false);
        expect(util.validate.email("@gmail.com")).toBe(false);
        expect(util.validate.email("henry@yahoo.")).toBe(false);
        expect(util.validate.email("o2@pl")).toBe(false);
        expect(util.validate.email("john@museum")).toBe(false);
        expect(util.validate.email("mckenzie.com")).toBe(false);
    });
});