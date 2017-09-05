# хелпер
# по большей части используются просто обертки для бутстраповых элементов,
# которые используются повсеместно

module Admin::AdminHelper
  delegate :url_helpers, to: 'Rails.application.routes'

  def empty_list
    content_tag :div, 'Пусто', class: 'well'
  end

  # все языки
  def get_languages
    Language.all
  end

  # вернуть все языки кроме текущей
  def get_another_locale
    get_languages.select do |l|
      l != @locale
    end
  end

  def get_alignments
    {
        'center center' => 'По центру',
        'left center' => 'По левому краю',
        'right center' => 'По правому краю',
        'center top' => 'По центру и верхнему краю',
        'left top' => 'По левому верхнему краю',
        'right top' => 'По правому вехнему краю',
        'center bottom' => 'По нижнему краю по центру',
        'left bottom' => 'По левому нижнему краю',
        'right bottom' => 'По правому нижнему краю'
    }
  end

  def save_or_update item
    if item.id then
      'Сохранить'
    else
      'Добавить'
    end
  end

  def link_list items
    render partial: 'admin/parts/link_list', locals: {items: items}
  end

  def with_pic item, image, size=:admin
    render partial: 'admin/parts/with_pic', locals: {item: item, image: image, size: size}
  end

  def image_field item, property, form, size=[], options={}
    render partial: 'admin/parts/form_avatar', locals: {
        image: item.send(property),
        item: item,
        property: property,
        form: form,
        field: form.file_field(property),
        size: size,
        options: options
    }
  end


  def locale_icon locale
    result = []
    result << content_tag(:i, '', class: ('icon icon-' + (get_item.locale_exists(locale.slug) ? 'pencil' : 'plus')))
    result << ' '
    result << locale.name
    result.join.html_safe
  end

  def get_path route, params, additional = false
    url_helpers.send(route, params.symbolize_keys)
  end

  def icon(type, white = false)
    content_tag :i, '', class: 'icon-' + type + (' icon-white' if white).to_s
  end

  def trash_icon(white = false)
    icon "trash", white
  end

  def down_icon(white = false)
    icon "arrow-down", white
  end

  def up_icon(white = false)
    icon "arrow-up", white
  end

  def pencil_icon(white = false)
    icon "pencil", white
  end

  def plus_icon(white = false)
    icon "plus", white
  end

  def tabs items, options={}
    render partial: 'admin/parts/tabs', locals: {items: items, options: options}
  end

  def get_item
    eval '@' + get_item_name
  end

  def get_item_name dirty=false
    name = controller_name

    if !dirty and ['good_categories', 'post_categories'].include? name
      name = 'categories'
    end

    name.singularize
  end

  def language_prompt
    render partial: 'admin/parts/language_prompt', locals: {item: get_item}
  end

  def language_select(route=nil)
    route ||= 'languaged_' + controller.class.name.split('::').first.downcase + '_' + get_item_name(true)
    render partial: 'admin/parts/language_select', locals: {route: route + '_path', item: get_item}
  end

  def form_errors form
    render partial: 'admin/parts/form_errors', locals: {object: form.object}
  end

  def language_input form
    render partial: 'admin/parts/form_language_input', locals: {form: form}
  end

  def category_types
    ['goods', 'blogs']
  end

  def tab_pane name, options={}, &block
    content = capture(&block)
    render partial: 'admin/parts/tab_pane', locals: {content: content, name: name, options: options}
  end

  # название текущего роута
  def current_route
    Rails.application.routes.router.recognize(request) do |route, _|
      return route.name
    end
  end

  def tab_contents &block
    content = capture(&block)
    content_tag :div, content, class: 'tab-content'
  end
end