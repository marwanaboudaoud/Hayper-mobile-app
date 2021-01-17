import React, { useEffect } from "react";
import Menu from "../../components/menu/Menu";
import generalStyles from "../general.module.scss";
import Logo from "../../assets/img/icons/score-logo.svg";
import LogoBackground from "../../assets/img/icons/scoro-logo-background.svg";
import Speaker from "../../assets/img/icons/speaker.svg";
import Newspaper from "../../assets/img/icons/news-paper.svg";
import Dashboard from "../../assets/img/icons/dashboard.svg";
// import Heart from "../../assets/img/icons/heart.svg";
import IconBackground from "../../assets/img/icons/score-icons-background.svg";
import styles from "./index.module.scss";
import { Col, Row } from "react-bootstrap";
import { connect } from 'react-redux';
import { fetchMyScore } from "../../actions/scoreAction";
import Spinner from "../../components/Spinner";


const Score = ({ fetchMyScore, score, loading }) => {
  console.log(score)
  useEffect(() => {
    fetchMyScore({
    })
  }, []);

  return (
    <div
      className="container"
      style={{
        height: "100vh",
        justifyContent: "unset",
        alignItems: "unset"
      }}
    >

      <div className={generalStyles.header}>
        <Menu />
        <h4 className={generalStyles.headerTitle}>Score</h4>
      </div>
      <div className={styles.logoContainer}>
        <img src={LogoBackground} alt="" />
        <img className={styles.logoImg} src={Logo} alt="" />
      </div>
      <p className={styles.username}>John Langeachternaam </p>
      <div style={{ marginTop: "20px" }}>
        <Row style={{ justifyContent: "center" }}>
          <Col xs={5} className={styles.ColContainers}>
            <div className={styles.iconsContainers}>
              <img src={IconBackground} alt=""></img>
              <img className={styles.iconImg} src={Speaker} alt=""></img>
              <p className={styles.iconsP}>{loading ? <Spinner width={24} color={'white'} type={'ThreeDots'} /> : `x${score.total_shifts}`}</p>
            </div>
            <p className={styles.description}> Aantal shifts</p>
          </Col>
          <Col xs={5} className={styles.ColContainers}>
            <div className={styles.iconsContainers}>
              <img src={IconBackground} alt=""></img>
              <img className={styles.iconImg} src={Newspaper} alt=""></img>
              <p className={styles.iconsP}>x30</p>
            </div>
            <p className={styles.description}>Aantal inschrijvingen </p>
          </Col>
        </Row>
        <Row style={{ justifyContent: "center" }}>
          <Col xs={10} className={styles.ColContainers}>
            <div className={styles.iconsContainers}>
              <img src={IconBackground} alt=""></img>
              <img className={styles.iconImg} src={Dashboard} alt=""></img>
              <p className={styles.iconsP}>1.5</p>
            </div>
            <p className={styles.description}>Gemiddelde score per shift</p>
          </Col>
          {/* <Col xs={5} className={styles.ColContainers}>
              <div className={styles.iconsContainers}>
                <img src={IconBackground} alt=""></img>
                <img className={styles.iconImg} src={Heart} alt=""></img>
                <p className={styles.iconsP}>x2</p>
              </div>
              <p className={styles.description}>Vrienden aangemeld</p>
            </Col> */}
        </Row>
      </div>
    </div>
  );
}

const mapStateToProps = state => ({
  score: state.score.score,
  loading: state.score.loading
})


export default connect(mapStateToProps, { fetchMyScore })(Score);
