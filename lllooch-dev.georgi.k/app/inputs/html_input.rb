# wysiwyg-редактор для SimpleForm
class HtmlInput < SimpleForm::Inputs::FileInput
  def input
    # get this custom attribute from :input_html
    # size = input_html_options.delete(:preview_size)
    input_html_options[:data] = {action: 'redactor', minheight: '180'}
    input_html_options[:class] << 'input-block-level'
    res = ''
    # if object.send("#{attribute_name}?")
    #   res << template.image_tag(object.send(attribute_name).tap {|o| break o.send(size) if size}.send('url'))
    # end
    (res << @builder.input_field(attribute_name, input_html_options)).html_safe
  end
end