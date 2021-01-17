import React,{useState,useEffect} from 'react'
import ReactPaginate from 'react-paginate';
import Polygon from '../../assets/img/icons/polygon.svg'
import {connect} from 'react-redux';
import { updateTablePage } from '../../actions/tableActions';
import { If } from 'react-if';

const TablePagination = ({body,updateTablePage, total_items, total_pages, page, pageLimit}) => {
    const [pageCount, setPageCount] = useState(total_pages)
    const itemsPerPage = () => {
        if(total_items < pageLimit ){
            return total_items
        } return pageLimit
    };
    itemsPerPage();
    useEffect(() => {
      setPageCount(total_pages)
    }, [total_pages])

    const startItem = 1 + ((page - 1) * pageLimit);
    const endItem = () => {
        if(page * (pageLimit) > total_items) {
            return total_items
        }
        return page * (pageLimit)
    };

    return (
        <If condition={body.length !== 0}>
          <div className="table__pagination">
            <p>{`${startItem} tot ${endItem()} van de ${total_items}`}</p>
            <ReactPaginate
              forcePage={page - 1}
              previousLabel={  <img className="pagination__arrowLeft" src={Polygon}/>}
              nextLabel={  <img className="pagination__arrowRight" src={Polygon}/>}
              breakLabel={''}
              breakClassName={'break-me'}
              pageCount={pageCount}
              marginPagesDisplayed={2}
              pageRangeDisplayed={1}
              onPageChange={data => updateTablePage(data.selected + 1)}
              containerClassName={'pagination'}
              subContainerClassName={'pages pagination'}
              activeClassName={'pagination__active'}
            />
          </div>
        </If>
    )
}

const mapStateToProps = state => ({
  page: state.table.filters.page,
  total_items: state.table.data.total_items,
  total_pages: state.table.data.total_pages,
  pageLimit : state.table.filters.limit,
  body:state.table.data.body,
})

export default connect(mapStateToProps,{updateTablePage})(TablePagination)
