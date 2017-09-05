# Контроллер постов блога
class Content::PostsController < Content::BaseController
  before_action :get_locale

  def get_item
    @post
  end

  def item
    @post = Post.find_by_slug params[:slug]
    @comments = @post.comments.where( locale: I18n.locale )
    raise PageNotFound unless @post.present?
  end
end
