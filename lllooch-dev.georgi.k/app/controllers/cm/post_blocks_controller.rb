# CRUD блоков поста
class Cm::PostBlocksController < Cm::BaseController
  include MultilingualController

  before_action :set_post_block, only: [:show, :edit, :update, :destroy]
  before_action :set_post, except: [:show, :order, :destroy]

  # GET /post_blocks
  # GET /post_blocks.json
  def index
    @post_blocks = PostBlock.all
  end

  # GET /post_blocks/1
  # GET /post_blocks/1.json
  def show
    @post = @post_block.post
  end

  # GET /post_blocks/new
  def new
    @post_block = PostBlock.new
  end

  # GET /post_blocks/1/edit
  def edit
  end

  # POST /post_blocks
  # POST /post_blocks.json
  def create
    @post_block = PostBlock.new(post_block_params)
    # ставим блок в самый конец поста
    @post_block.weight = @post.blocks.size

    respond_to do |format|
      if @post_block.save
        format.html { redirect_to edit_cm_post_block_url(@post, @post_block), notice: 'Post block was successfully created.' }
        format.json { render action: 'show', status: :created, location: @post_block }
      else
        @errors = @post_block.errors
        abort @errors.to_s
        format.html { render action: 'new' }
        format.json { render json: @post_block.errors, status: :unprocessable_entity }
      end
    end
  end

  # PATCH/PUT /post_blocks/1
  # PATCH/PUT /post_blocks/1.json
  def update
    respond_to do |format|
      if @post_block.update(post_block_params)
        format.html { redirect_to url_for(controller: 'cm/post_blocks', action: :index, post_id: @post.id), notice: 'Post block was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: 'edit' }
        format.json { render json: @post_block.errors, status: :unprocessable_entity }
      end
    end
  end

  def order
    errors = []

    if order_params
      order_params.each_with_index do |id, weight|
        post_block = PostBlock.find id
        post_block.weight = weight

        unless post_block.save :validate => false
          errors << post_block.errors
        end
      end
    end

    respond_to do |format|
      if errors.empty?
        format.json { head :no_content }
      else
        format.json { render json: errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /post_blocks/1
  # DELETE /post_blocks/1.json
  def destroy
    post = @post_block.post
    @post_block.destroy
    respond_to do |format|
      format.html { redirect_to url_for(controller: 'cm/post_blocks', action: :index, post_id: post.id) }
      format.json { head :no_content }
    end
  end

  private
    def set_post_block
      @post_block = PostBlock.find(params[:id])
    end

    def set_post
      @post = Post.find(params[:post_id])
    end

    def safe_params
      [:type, :post_id, :picture, :content]
    end

    # Never trust parameters from the scary internet, only allow the white list through.
    def post_block_params
      permit_params
    end

    def order_params
      params.require(:order)
    end
end
