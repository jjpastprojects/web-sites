Caman.Filter.register("hue_partial", function(adjust, y) {
  return this.process("hue_partial", function(rgba) {

    if(rgba.locationXY().y <= y)
      return false;
    
    var b, g, h, hsv, r, _ref;
    hsv = Caman.Convert.rgbToHSV(rgba.r, rgba.g, rgba.b);
    h = hsv.h * 100;
    h += Math.abs(adjust);
    h = h % 100;
    h /= 100;
    hsv.h = h;
    _ref = Caman.Convert.hsvToRGB(hsv.h, hsv.s, hsv.v), r = _ref.r, g = _ref.g, b = _ref.b;
    rgba.r = r;
    rgba.g = g;
    rgba.b = b;
    return rgba;
  });
});